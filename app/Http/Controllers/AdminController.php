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

        return view('Management_pages.dashboard',$data);
    }

    public function users(){

        // admin  middleware oluşturma yap
        // admin middleware dosyası oluşturuldu
        // önce tüm projeyi profil yerine user üzerinde yürütmeyi hallet

        $data['users'] = User::orderBy('id','asc')
        ->paginate(20);

        $data['page'] = 'users';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        return view('Management_pages.user.list' , $data);
    }

    public function category(){

        $data['page'] = 'categories';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        $data['getRecord'] = Category::getRecord();     // eğer self ile erişim sağlıyorsan fonksiyon static olarak oluşturulmalı
        return view('Management_pages.category.list' , $data);
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

        return view('Management_pages.blog.list',$data);
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

        return view('Management_pages.pending_blogs.list', $data);

    }

    public function tags_list(){

        // admin  middleware oluşturma yap
        // admin middleware dosyası oluşturuldu
        // önce tüm projeyi profil yerine user üzerinde yürütmeyi hallet
        
        $data['page'] = 'tags';
        $data['user'] = Auth::user();
        $data['count'] = Tag::all()->count();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        $data['tags'] = Tag::paginate(15);

        return view('Management_pages.tag.list',$data);
    }


    public function change_password(){

        $data['page'] = 'change_password';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        return view('Management_pages.change_password',$data);
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

        return view('Management_pages.change_password',$data);
    }

    public function site_settings(){
        $site_setting = SiteSetting::first();
        $data['site_setting'] = $site_setting;

        $site_logos = File::files('site_settings/site_logo/');
        $site_favicons = File::files('site_settings/site_favicon/');
        $logos = [];
        foreach ($site_logos as $file) {
            $logos[] = $file->getFilename();
        }
        $favicons = [];
        foreach ($site_favicons as $file) {
            $favicons[] = $file->getFilename();
        }

        $data['site_logos'] = $logos;
        $data['favicons'] = $favicons;

        $data['blogs'] = Blog::where('status',1)->where('is_confirmed',1)->select('id','title')->get();

        $data['page'] = 'site_settings';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        return view('Management_pages.site_settings',$data);
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
            'editors_pick' => 'required',
            'contact_email' => 'required'
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
        $site_setting->editors_pick_blog_id = $request->input('editors_pick');
        $site_setting->contact_email = $request->input('contact_email');

        $is_saved = $site_setting->save();

        if($is_saved){
            return redirect()->route('site_settings')->with('success','Website settings updates succesfully!');
        }else{
            return redirect()->back()->with('error', 'Could not update! ');

        }



    }
}
