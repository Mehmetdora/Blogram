<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    //Github

    public function github_redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function github_callback()
    {
        try {

            $user = Socialite::driver('github')->user();

            $finduser = User::where('github_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);
                return redirect()->route('home');

            } else {

                if (User::where('email', $user->email)->where('status', 0)->exists()) {
                    // bu email ile kullanıcı var ve silinmemiş bir kullanıcı

                    $user_withuot_github = User::where('email', $user->email)->first();
                    $user_withuot_github->github_id = $user->id;
                    $user_withuot_github->github_token = $user->token;
                    $user_withuot_github->github_refresh_token = $user->refreshToken;
                    $user_withuot_github->save();

                    Auth::login($user_withuot_github);
                    return redirect()->route('check_profile');

                } else {

                    $new_user = new User();
                    $new_user->name = $user->name;
                    $new_user->email = $user->email;
                    $new_user->gender = false;

                    $new_user->github_id = $user->id;
                    $new_user->github_token = $user->token;
                    $new_user->github_refresh_token = $user->refreshToken;
                    $new_user->remember_token = Str::random(40);

                    $new_user->save();

                    Auth::login($new_user);
                    return redirect()->route('check_profile');

                }
            }

        } catch (Exception $e) {
            return redirect()->route('error_404');
        }
    }

    //Google
    public function google_redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);
                return redirect()->route('home');

            } else {

                if (User::where('email', $user->email)->where('status', 0)->exists()) {
                    // bu email ile kullanıcı var ve silinmemiş bir kullanıcı

                    $user_withuot_google = User::where('email', $user->email)->first();
                    $user_withuot_google->google_id = $user->id;
                    $user_withuot_google->google_token = $user->token;
                    $user_withuot_google->google_refresh_token = $user->refreshToken;
                    $user_withuot_google->save();

                    Auth::login($user_withuot_google);
                    return redirect()->route('check_profile');

                }else {

                    $new_user = new User();
                    $new_user->name = $user->name;
                    $new_user->email = $user->email;
                    $new_user->gender = false;

                    $new_user->google_id = $user->id;
                    $new_user->google_token = $user->token;
                    $new_user->google_refresh_token = $user->refreshToken;
                    $new_user->remember_token = Str::random(40);

                    $new_user->save();

                    Auth::login($new_user);
                    return redirect()->route('check_profile');

                }
            }

        } catch (Exception $e) {
            return redirect()->route('error_404');
        }
    }
}
