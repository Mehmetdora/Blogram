<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Profile;
use App\Mail\RegisterMail;
use App\Models\SiteSetting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function delete_user(){

        $user = auth()->user();
        // Kullanıcı oturum açmamışsa veya kimlik doğrulama başarısızsa işlem yapılmaz
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to delete your account.');
        }

        $blogs = $user->blogs;
        $comments = $user->comments;
        $notifications = $user->notifications;
        $categories = $user->categories;
        $profile = $user->profile;
        $liked_blogs = $user->liked_blogs;
        $saved_blogs = $user->saved_blogs;

        $oldUserPicture = $user->photo;
        if ($user->photo && file_exists(public_path('uploads/') . $user->photo)) {
            if($oldUserPicture != 'Default_pfp_women.png' && $oldUserPicture != 'Default_pfp.jpg'){ // default resim kontrolü değilse sil
                unlink(public_path('uploads/' . $oldUserPicture));  // unlink ile fotoğraf silinir
            }        }


        if(isset($notifications)){
            foreach($notifications as $notification){
                $notification->delete();
            }
        }

        foreach ($blogs as $blog) {

            if(isset($blog->tags)){
                $blog->tags()->detach();
            }

            if(isset($blog->images)){
                foreach($blog->images as $image) {
                    unlink(public_path('blog_images/description_photos/') . $image->image_name);
                    $image->delete();
                }
            }

            unlink(public_path('blog_images/cover_photos/') . $blog->cover_photo);

            $blog->status = 0;
            $blog->save();
        }

        if(isset($comments)){
            foreach ($comments as $comment) {
                $comment->delete();
            }
        }

        if(isset($categories)){
            $user->categories()->detach();
        }

        $profile->delete();

        if(isset($liked_blogs)){
            $user->liked_blogs()->detach();
        }

        if(isset($saved_blogs)){
            $user->saved_blogs()->detach();
        }


        $user->status = 1;  //silindi
        $user->photo = $user->gender ? 'Default_pfp_women.png' : 'Default_pfp.jpg';
        $user->bio = '';
        $user->skill = '';
        $user->save();

        Auth::logout();
        return redirect()->route("welcome")->with("success","Hesabınız ve tüm verileriniz silinmiştir. Öneri ve şikayetlerinizi lütfen bildiriniz. İyi günler...");
    }


    public function login()
    {
        $data['site_setting'] = SiteSetting::first();

        return view( 'Public_pages.auth.login',$data);

    }

    public function check_profile(){

        if(Auth::user()->profile){

            if(session()->get('url.intended')){
                $url = session()->get('url.intended');

                $path = parse_url($url, PHP_URL_PATH);

                // '/' karakterine göre böl ve son parçayı al
                $segments = explode('/', rtrim($path, '/'));
                $id = end($segments);

                if(is_numeric($id)){
                    return redirect()->route('blogs.show',$id);
                }
            }

            return redirect()->route('home');

        }

        return redirect()->route('profile.create');

    }

    public function auth_login(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;


        if(Auth::attempt(['email' => $request->email , 'password' => $request->password,'status' => 0] , $remember)){
            $user = Auth::user();
            if (!empty($user->email_verified_at)) {

                if($user->is_admin == 1){
                    return redirect()->route('dashboard');
                }else{
                    $blog_url = session()->get('url.intended');
                    session(['url.intended' => $blog_url]);

                    return redirect()->route('check_profile');
                }
            }
            else{
                $user_id = Auth::user()->id;
                Auth::logout();
                $save = User::getSingle($user_id);
                $save->remember_token = Str::random(40);
                $save->save();

                Mail::to($save->email)->send( new RegisterMail($save));

                return redirect()->back()->with('error' , "Please verify your email address");

            }

        }
        else{
            return redirect()->back()->with('error' , 'Please enter correct email and password ');

        }

    }

    public function register()
    {
        $data['site_setting'] = SiteSetting::first();
        return view('Public_pages.auth.register',$data);

    }
    public function forgot()
    {
        return view('Public_pages.auth.forgot');

    }

    public function forgot_password(Request $request){
        $user = User::where('email' , '=' , $request->email)->first();
        if(!empty($user)){
            $user->remember_token = Str::random(40);
            $user->save();

            Mail::to($user->email)->send( new ForgotPasswordMail($user));
            return redirect()->back()->with('success' , 'Please check your email to reset your password.');
        }
        else{
            return redirect()->back()->with('error' , 'This email is not registered.');
        }
    }

    public function reset($token){
        $user = User::where('remember_token' , '=' , $token)->first();
        if(!empty($user)){
            $data['user'] = $user;
            return view('Public_pages.auth.reset');
        }
        else{
            abort(404);
        }
    }

    public function reset_post($token , Request $request){
        $user = User::where('remember_token' , '=' , $token)->first();
        if(!empty($user)){
            if($request->password == $request->cpassword){
                $user->password = Hash::make($request->password);
                if(empty($user->email_verified_at)){
                    $user->email_verified_at = date('Y-m-d H:i:s');
                }
                $user->remember_token = Str::random(40);
                $user->save();

                return redirect('login')->with('success' , 'Password changed successfully');

            }
            else{
                return redirect()->back()->with('error' , 'Password and Confirm Password did not match');
            }
        }
        else{
            abort(404);
        }


    }
    public function create_user(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed|unique:users,password',
        ]);

        if(User::where('email',$request->email)->exists()){
            // silinen hesabın tekrar kayıt olma işlemleri
            $user = User::where('email',$request->email)->first();
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(40);
            $user->save();

            $data['user'] = $user;
            $data['question'] = 'Bu mail adresi ile eski bir hesabınızın bağlantılı olduğunu tespit ettik.Eski hesabınız ile yeni bir profil oluşturarak devam etmek istiyor musunuz?';
            $data['site_setting'] = SiteSetting::first();

            return view('Public_pages.auth.register',$data);
        }else{
            request()->validate([
                'email' => 'required|email|max:255|unique:users',
            ]);
        }

        $save = new User();
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        $save->gender = false;
        $save->password = Hash::make($request->password);
        $save->remember_token = Str::random(40);
        $save->save();

        Mail::to($save->email)->send( new RegisterMail($save));
        return redirect('login')->with('success' , "Your account register successfully and verify your email address");

    }

    public function verify_old_user(Request $request){

        try{
            $user = User::find($request->user_id);
            $user->status = 0;  // eski hesabı geri getirme 0 aktif demek
            $user->save();
            //Mail::to($user->email)->send( new RegisterMail($user));
            return response()->json(['success' => true,'redirect_url'=>route('login')]);

        }catch(Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

    }

    public function verify($token)
    {
        $user = User::where('remember_token', '=' , $token)->first();
        if(!empty($user)){
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->remember_token = Str::random(40);
            $user->save();

            return redirect('login')->with('success' , "Your account successfully verified");

        }
        else{
            abort('404');
        }

    }
    public function logout()
    {
        Auth::logout();
        session(['url.intended' => null]);  // tekrar giriş yapacağı zaman eski url adresinin sessiondan kaldırma
        return redirect()->route('welcome');
    }

}
