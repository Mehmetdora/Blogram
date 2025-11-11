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
use App\Mail\TestMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function delete_user()
    {

        $user = Auth::user();
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
            if ($oldUserPicture != 'Default_pfp_women.png' && $oldUserPicture != 'Default_pfp.jpg') { // default resim kontrolü değilse sil

                $directory = public_path('uploads/') . $oldUserPicture;
                if (file_exists($directory)) {
                    unlink(public_path('uploads/') . $oldUserPicture);  // unlink ile fotoğraf silinir
                }
            }
        }


        if (isset($notifications)) {
            foreach ($notifications as $notification) {
                $notification->delete();
            }
        }

        foreach ($blogs as $blog) {

            if (isset($blog->tags)) {
                $blog->tags()->detach();
            }

            if (!empty($blog->images)) {
                foreach ($blog->images as $image) {

                    $directory = public_path('blog_images/description_photos/') . $image->image_name;
                    if (file_exists($directory)) {
                        unlink(public_path('blog_images/description_photos/') . $image->image_name);
                    }
                    $image->delete();
                }
            }
            if (!empty($blog->cover_photo)) {

                $directory = public_path('blog_images/cover_photos/') . $blog->cover_photo;
                if (file_exists($directory)) {
                    unlink(public_path('blog_images/cover_photos/') . $blog->cover_photo);
                }
            }

            $blog->delete();
        }

        if (isset($comments)) {
            foreach ($comments as $comment) {
                $comment->delete();
            }
        }

        if (isset($categories)) {
            $user->categories()->detach();
        }

        $profile->delete();

        if (isset($liked_blogs)) {
            $user->liked_blogs()->detach();
        }

        if (isset($saved_blogs)) {
            $user->saved_blogs()->detach();
        }



        Auth::logout();
        $user->delete();


        return redirect()->route("welcome")->with("success", "Hesabınız ve tüm verileriniz silinmiştir. Öneri ve şikayetlerinizi lütfen bildiriniz. İyi günler...");
    }


    public function login()
    {
        $data['site_setting'] = SiteSetting::first();

        return view('Public_pages.auth.login', $data);
    }

    public function check_profile()
    {

        if (Auth::user()->profile) {

            if (session()->get('url.intended')) {
                $url = session()->get('url.intended');

                $path = parse_url($url, PHP_URL_PATH);

                // '/' karakterine göre böl ve son parçayı al
                $segments = explode('/', rtrim($path, '/'));
                $id = end($segments);

                if (is_numeric($id)) {
                    return redirect()->route('blogs.show', $id);
                }
            }

            return redirect()->route('home');
        }

        return redirect()->route('profile.create');
    }

    public function auth_login(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 0], $remember)) {
            $user = Auth::user();
            if (!empty($user->email_verified_at)) {

                if ($user->is_admin == 1) {
                    return redirect()->route('dashboard');
                } else {
                    $blog_url = session()->get('url.intended');
                    session(['url.intended' => $blog_url]);

                    return redirect()->route('check_profile');
                }
            } else {
                $user_id = Auth::user()->id;
                Auth::logout();
                $save = User::getSingle($user_id);
                $save->remember_token = Str::random(40);
                $save->save();

                Mail::to($save->email)->send(new RegisterMail($save));

                return redirect()->back()->with('error', "Please verify your email address");
            }
        } else {
            return redirect()->back()->with('error', 'Please enter correct email and password ');
        }
    }

    public function register()
    {
        $data['site_setting'] = SiteSetting::first();
        return view('Public_pages.auth.register', $data);
    }

    public function forgot()
    {
        return view('Public_pages.auth.forgot');
    }

    public function forgot_password(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();
        if (!empty($user)) {
            $user->remember_token = Str::random(40);
            $user->save();

            try {
                Mail::to($user->email)->send(new ForgotPasswordMail($user));

                Log::info("Mail gönderildi!");
            } catch (\Exception $e) {
                Log::error("Mail gönderilemedi: " . $e->getMessage());
            }
            return redirect()->back()->with('success', 'Now check your email to reset your password.');
        } else {
            return redirect()->back()->with('error', 'This email is not registered.');
        }
    }

    public function reset($token)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) {
            $data['user'] = $user;
            return view('Public_pages.auth.reset');
        } else {
            return redirect()->route('error_404');
        }
    }

    public function reset_post($token, Request $request)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) {
            if ($request->password == $request->cpassword) {
                $user->password = Hash::make($request->password);
                if (empty($user->email_verified_at)) {
                    $user->email_verified_at = date('Y-m-d H:i:s');
                }
                $user->remember_token = Str::random(40);
                $user->save();

                return redirect('login')->with('success', 'Password changed successfully');
            } else {
                return redirect()->back()->with('error', 'Password and Confirm Password did not match');
            }
        } else {
            return redirect()->route('error_404');
        }
    }

    public function create_user(Request $request)   // kullanıcı email ile hesap oluşturmak isterse
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed|unique:users,password',
        ]);

        try {

            if (User::where('email', $request->email)->where('status', 0)->exists()) {
                // Kullanıcı google ile kayıtlı iken email ile kayıt olmak isterse

                $user = User::where('email', $request->email)->where('status', 0)->first();

                if ($user->email_verified_at == null) {
                    $user->name = $request->name;
                    $user->password = Hash::make(request()->password);
                    $user->remember_token = Str::random(40);
                    $user->save();

                    try {
                        $register_url = route('verify', $user->remember_token);
                        Mail::to($user->email)->send(new RegisterMail($user, $register_url));
                        Log::info("Mail gönderildi!");
                    } catch (\Exception $e) {
                        Log::error("Mail gönderilemedi: " . $e->getMessage());
                    }
                    return redirect('login')->with('success', "Your registration with email is done successfully , now verify your email address and start learning");
                } else {
                    return redirect('login')->with('error', "There is a registered user with this email address. Please try another email address that is not registered.");
                }
            } else {    // YENİ EMAİL KULLANIXI KAYDI
                request()->validate([
                    'email' => 'required|email|max:255|unique:users',
                ]);

                $save = new User();
                $save->name = trim($request->name);
                $save->email = trim($request->email);
                $save->gender = false;
                $save->password = Hash::make($request->password);
                $save->remember_token = Str::random(40);
                $save->save();

                try {
                    $register_url = route('verify', $save->remember_token);
                    Mail::to($save->email)->send(new RegisterMail($save, $register_url));
                    Log::info("Mail gönderildi!");
                } catch (\Exception $e) {
                    Log::error("Mail gönderilemedi: " . $e->getMessage());
                }
                return redirect('login')->with('success', "One more step, verify your email address to start... 🚀");
            }
        } catch (\Exception $err) {
            return redirect()->back()->with("error", $err);
        }
    }





    public function verify($token)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->remember_token = Str::random(40);
            $user->save();

            return redirect('login')->with('success', "Your account successfully verified");
        } else {
            return redirect()->route('error_404');
        }
    }

    public function logout()
    {
        Auth::logout();
        session(['url.intended' => null]);  // tekrar giriş yapacağı zaman eski url adresinin sessiondan kaldırma
        return redirect()->route('welcome');
    }
}
