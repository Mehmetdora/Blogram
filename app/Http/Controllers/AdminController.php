<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use App\Models\SiteSetting;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard(){

        // admin  middleware oluşturma yap
        // admin middleware dosyası oluşturuldu
        // önce tüm projeyi profil yerine user üzerinde yürütmeyi hallet

        $data['page'] = 'dashboard';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        $data['user_count'] = count(User::where('is_admin',0)->where('is_delete',0)->get());
        $data['blog_count_approved'] = count(Blog::where('status',1)->get());

        return view('Admin.dashboard',$data);
    }

    public function users(){

        // admin  middleware oluşturma yap
        // admin middleware dosyası oluşturuldu
        // önce tüm projeyi profil yerine user üzerinde yürütmeyi hallet

        $data['users'] = User::where('is_delete',0)
        ->orderBy('id','asc')
        ->paginate(20);

        $data['page'] = 'users';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        return view('Admin.user.list' , $data);
    }

    public function category(){

        $data['page'] = 'categories';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        $data['getRecord'] = Category::getRecord();     // eğer self ile erişim sağlıyorsan fonksiyon static olarak oluşturulmalı
        return view('Admin.category.list' , $data);
    }

    public function blogs_comments(){

        // admin  middleware oluşturma yap
        // admin middleware dosyası oluşturuldu
        // önce tüm projeyi profil yerine user üzerinde yürütmeyi hallet

        $data['page'] = 'blogs_comments';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        $data['blogs'] = Blog::where('status',1)
        ->where('is_confirmed',1)
        ->orderBy('created_at','desc')
        ->paginate(12);




        return view('Admin.blog.list',$data);
    }

    public function pending_blogs(){

        $data['page'] = 'pending_blogs';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        $data['blogs'] = Blog::where('status',1)
        ->where('is_confirmed',0)
        ->orderBy('created_at','desc')
        ->paginate(12);


        return view('Admin.pending_blogs.list', $data);

    }

    public function tags_list(){

        // admin  middleware oluşturma yap
        // admin middleware dosyası oluşturuldu
        // önce tüm projeyi profil yerine user üzerinde yürütmeyi hallet

        $data['page'] = 'change_password';
        $data['user'] = Auth::user();
        $data['count'] = Tag::all()->count();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        $data['tags'] = Tag::paginate(15);

        return view('Admin.tag.list',$data);
    }



    public function changed_password(Request $request){

        $validatedData = Validator::make($request->all(), [
            'new_password' => 'required|min:6',
            'old_password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
        ]);
        if ($validatedData->fails()) {
            // Hata mesajlarını alın
            $errors = $validatedData->errors()->all(); // istersek laravelin kendi hatam mesajını da gönderebiliriz
            // E-posta veya şifrenin hatalı olduğunu belirten özel bir hata mesajı oluşturun
            $errorMessage = 'Girilen email veya şifre formatı hatalı!';
            // Hata mesajlarını kullanıcıya gösterin
            return redirect()->back()->with('error', $errors);
        }

        $user = User::find(Auth::user()->id);

        if (Hash::check($request->old_password, $user->password)) {
            if ($request->new_password == $request->confirm_password) {
                $user->password = Hash::make($request->new_password);
                $user->save();

                return redirect()->back()->with('success', 'Password updated successfully');
            } else {
                return redirect()->back()->with('error', 'New password and confirm password does not match.');
            }
        } else {
            return redirect()->back()->with('error', 'Old password is wrong.');
        }

        $data['page'] = 'change_password';
        $data['user'] = Auth::user();

        return view('Admin.change_password',$data);
    }

    public function site_settings(){
        $site_setting = SiteSetting::first();
        $data['site_setting'] = $site_setting;
        $files = File::files('site_settings/site_logo/');

        $fileNames = [];
        foreach ($files as $file) {
            $fileNames[] = $file->getFilename();
        }

        $data['logo_photos'] = $fileNames;

        $data['page'] = 'site_settings';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        return view('Admin.site_settings',$data);
    }

    public function save_site_settings(Request $request){


        $validatedData = Validator::make($request->all(), [
            'site_name' => 'required',
            'logo_url' => 'required',
            'favicon_url' => 'required',
            'theme_color' => 'required',
            'background_color' => 'required',
            'font_family' => 'required',
            'font_size' => 'required',
            'header_image_url' => 'required',
            'footer_text' => 'required',
            'is_dark_mode_enabled' => 'required',
            'default_language' => 'required',
            'maintenance_mode' => 'required',
            'maintenance_message' => 'required',
        ]);
        if ($validatedData->fails()) {
            // Hata mesajlarını alın
            $errors = $validatedData->errors()->all(); // istersek laravelin kendi hatam mesajını da gönderebiliriz
            // E-posta veya şifrenin hatalı olduğunu belirten özel bir hata mesajı oluşturun
            $errorMessage = 'Girilen email veya şifre formatı hatalı!';
            // Hata mesajlarını kullanıcıya gösterin
            return redirect()->back()->with('error', $errors);
        }

        $site_setting = SiteSetting::first();
        $site_setting->site_name = $request->input('site_name');
        $site_setting->logo_url = $request->input('logo_url');
        $site_setting->favicon_url = $request->input('favicon_url');
        $site_setting->theme_color = $request->input('theme_color');
        $site_setting->background_color = $request->input('background_color');
        $site_setting->font_family = $request->input('font_family');
        $site_setting->font_size = $request->input('font_size');
        $site_setting->header_image_url = $request->input('header_image_url');
        $site_setting->footer_text = $request->input('footer_text');
        $site_setting->is_dark_mode_enabled = $request->input('is_dark_mode_enabled');
        $site_setting->default_language = $request->input('default_language');
        $site_setting->maintenance_mode = $request->input('maintenance_mode');
        $site_setting->maintenance_message = $request->input('maintenance_message');

        $is_saved = $site_setting->save();

        if($is_saved){
            return redirect()->route('site_settings')->with('success','Website settings updates succesfully!');
        }else{
            return redirect()->back()->with('error', 'Could not update! ');

        }



    }
}
