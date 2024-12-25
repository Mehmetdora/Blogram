<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Profile;
use App\Models\Category;
use App\Models\SiteSetting;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show()
    {

        $data['site_setting'] = Cache::remember('site_setting',now()->addSeconds(60*60*3), function() {
            return SiteSetting::first();
        });


        $data['user'] = Auth::user();
        $data['categories'] = Category::where('is_delete',0)->where('status',1)->get();
        $data['blogs'] = Blog::where('status', 1)
        ->where('is_confirmed',1)
        ->where('user_id', Auth::user()->id)
        ->orderBy('created_at', 'desc')
        ->paginate(5);

        $user_id = Auth::id();
        // Önce profili bul ama user üzerinde bulmada id kullanarak bul
        //for içinde ilişkili olduğu categorileri dön ve işlemlerini yap
        $user = User::with('categories')->find($user_id);
        $user_categories = $user->categories;
        foreach ($user_categories as $category) {
            $category->blogs_count = Blog::where('category_id', $category->id)
                ->where('status', 1) // Sadece aktif olanlar
                ->where('is_confirmed',1)
                ->count();
        }
        $data['user_categories'] = $user_categories;
        $data['notifications'] = $user->notifications()->where('status',true)->orderBy('created_at','desc')->take(10)->get();
        $data['notifications_count'] = Auth::user()->notifications()->whereNull('read_at')->count();

        return view('Authenticated_pages.profile.show', $data);
    }
    public function edit()
    {
        $user_id = Auth::user()->id;
        // Önce profili bul ama user üzerinde bulmada id kullanarak bul
        //for içinde ilişkili olduğu categorileri dön ve işlemlerini yap
        $data['site_setting'] = SiteSetting::first();

        $user = User::with('categories')->find($user_id);
        $user_categories = $user->categories;
        foreach ($user_categories as $category) {
            $category->blogs_count = Blog::where('category_id', $category->id)
                ->where('status', 1) // Sadece aktif olanlar
                ->where('is_confirmed',1)
                ->count();
        }
        $data['user_categories'] = $user_categories;
        $data['user'] = Auth::user();
        $data['notifications'] = Auth::user()->notifications()->where('status',true)->orderBy('created_at','desc')->take(10)->get();
        $data['notifications_count'] = Auth::user()->notifications()->whereNull('read_at')->count();

        return view('Authenticated_pages.profile.edit', $data);
    }

    public function edited(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'profile_name'=>'required | max:20',
            'skills'=>'nullable | max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'gender'=>'required',
            'bio'=>'required',
        ]);
        if ($validatedData->fails()) {
            // Hata mesajlarını alın
            $errors = $validatedData->errors()->all(); // istersek laravelin kendi hatam mesajını da gönderebiliriz
            $errorMessage = 'Girilen email veya şifre formatı hatalı!';
            // Hata mesajlarını kullanıcıya gösterin
            return redirect()->back()->with('error', $errors);
        }

        $user = Auth::user();
        $oldUserPicture = $user->photo;       // eski fotoğrafı silme

        $user['name'] = $request->profile_name;
        $user['skill'] = $request->skills;
        $user['gender'] = $request->gender;
        $user['bio'] = $request->bio;
        $file_path = public_path('uploads');
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalName();
            $file->move($file_path, $filename);

            if ($oldUserPicture && file_exists(public_path('uploads/' . $oldUserPicture))) {        // FOTOĞRAF DEĞİŞİNCE ESKİ FOTOĞRAFI SİLİYORUZ
                if($oldUserPicture != 'Default_pfp_women.png' && $oldUserPicture != 'Default_pfp.jpg'){ // default resim kontrolü değilse sil
                    unlink(public_path('uploads/' . $oldUserPicture));  // unlink ile fotoğraf silinir
                }
            }

            $user['photo'] = $filename;
        }
        $sonuc = $user->save();
        if ($sonuc) {
            return redirect()->route('profile.show')->with('success', 'Informations updated successfully!');
        } else {
            return redirect()->back()->with('error', 'User infos update failed!');
        }
    }

    public function show_others($id) // gelen veri user id olmalı
    {

        $is_liked = [];


        $id = (int)$id; // GELEN VERİ HER ZAMAN STRİNG GELİR

        $data['categories'] = Category::where('is_delete',0)->where('status',1)->get();

        $user_id = Auth::user()->id;
        // Önce profili bul ama user üzerinde bulmada id kullanarak bul
        //for içinde ilişkili olduğu categorileri dön ve işlemlerini yap
        $user = User::with('categories')->find($user_id);
        $user_categories = $user->categories;
        foreach ($user_categories as $category) {
            $category->blogs_count = Blog::where('category_id', $category->id)
                ->where('status', 1) // Sadece aktif olanlar
                ->where('is_confirmed',1)
                ->count();
        }
        $data['user_categories'] = $user_categories;

        $blogs = Blog::with('liked_users')
        ->where('user_id', $id)
        ->where('is_confirmed',1)
        ->where('status', 1)
        ->get();   // profile ve beğendiği bloglar
        foreach ($blogs as $blog) {
            $is_liked[$blog->id] = $blog->liked_users->contains($user_id) ? 1 : 0;
        }   // her bloğun beğenenleri arasında giriş yapan kullanıcı varsa 1 , yoksa 0 yap

        $data['is_liked'] = $is_liked;
        $data['site_setting'] = SiteSetting::first();

        $data['user'] = User::find($id);  // bloğun yazarının profili
        $data['blogs'] = Blog::where('user_id', $id)
        ->where('status', 1)
        ->where('is_confirmed',1)
        ->orderby('id', 'desc')
        ->paginate(5);   // buloğun yazarının blogları
        $data['notifications'] = $user->notifications()->where('status',true)->orderBy('created_at','desc')->take(10)->get();
        $data['notifications_count'] = Auth::user()->notifications()->whereNull('read_at')->count();

        if ($id == $user_id) {
            return redirect()->route('profile.show', $data);
        } else {
            return view('Authenticated_pages.profileOthers', $data);
        }
    }


    public function notification_read_redirect($id){

        $notification = Notification::find($id);

        if ($notification) {
            $notification->read_at = now();
            $notification->save();

            return redirect($notification->url);
        }

        return redirect()->back()->with('error', 'Bildirim bulunamadı.');
    }


    public function saved_blogs(){


        $user_id = Auth::user()->id;
        // Önce profili bul ama user üzerinde bulmada id kullanarak bul
        //for içinde ilişkili olduğu categorileri dön ve işlemlerini yap
        $user = User::with('categories')->find($user_id);
        $user_categories = $user->categories;
        foreach ($user_categories as $category) {
            $category->blogs_count = Blog::where('category_id', $category->id)
                ->where('status', 1) // Sadece aktif olanlar
                ->where('is_confirmed',1)
                ->count();
        }
        $data['user_categories'] = $user_categories;

        $data['user'] = $user;
        $data['notifications'] = Auth::user()->notifications()->where('status',true)->orderBy('created_at','desc')->take(10)->get();
        $data['notifications_count'] = $user->notifications->whereNull('read_at')->count();
        $data['site_setting'] = SiteSetting::first();

        $data['saved_blogs'] = $user->saved_blogs()->where('status',1)->orderBy('created_at','desc')->paginate(10);

        return view('Authenticated_pages.myBlogs.saved',$data);
    }

}
