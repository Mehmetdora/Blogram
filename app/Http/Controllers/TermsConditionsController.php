<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class TermsConditionsController extends Controller
{
    public function privacy()
    {

        if (auth()->check()) {
            $data['logined'] = true;
            $user_id = \Illuminate\Support\Facades\Auth::id();
            // Önce profili bul ama user üzerinde bulmada id kullanarak bul
            //for içinde ilişkili olduğu categorileri dön ve işlemlerini yap
            $user = User::with('categories')->find($user_id);
            $user_categories = $user->categories;
            foreach ($user_categories as $category) {
                $category->blogs_count = Blog::where('category_id', $category->id)
                    ->where('status', 1) // Sadece aktif olanlar
                    ->where('is_confirmed', 1)
                    ->count();
            }
            $data['user_categories'] = $user_categories;

            $data['notifications'] = $user->notifications()->where('status', true)->orderBy('created_at', 'desc')->take(10)->get();
            $data['notifications_count'] = $user->notifications->where('status', 1)->whereNull('read_at')->count();


        } else {
            $data['logined'] = false;

        }

        $data['site_setting'] = SiteSetting::first();
        $data['title'] = 'Privacy Policy';

        return view('Terms_conditions.privacy_policy', $data);
    }

    public function terms()
    {
        if (auth()->check()) {
            $data['logined'] = true;
            $user_id = \Illuminate\Support\Facades\Auth::id();
            // Önce profili bul ama user üzerinde bulmada id kullanarak bul
            //for içinde ilişkili olduğu categorileri dön ve işlemlerini yap
            $user = User::with('categories')->find($user_id);
            $user_categories = $user->categories;
            foreach ($user_categories as $category) {
                $category->blogs_count = Blog::where('category_id', $category->id)
                    ->where('status', 1) // Sadece aktif olanlar
                    ->where('is_confirmed', 1)
                    ->count();
            }
            $data['user_categories'] = $user_categories;

            $data['notifications'] = $user->notifications()->where('status', true)->orderBy('created_at', 'desc')->take(10)->get();
            $data['notifications_count'] = $user->notifications->where('status', 1)->whereNull('read_at')->count();

        } else {
            $data['logined'] = false;
        }

        $data['site_setting'] = SiteSetting::first();
        $data['title'] = 'Terms & Conditions';

        return view('Terms_conditions.terms_conditions', $data);
    }
}
