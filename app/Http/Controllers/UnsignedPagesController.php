<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class UnsignedPagesController extends Controller
{

    public function welcome()
    {
        $data['title'] = 'welcome';
        $data['site_setting'] = SiteSetting::first();

        return view('Public_pages.welcome',$data);
    }

    public function about()
    {
        $data['title'] = 'about';
        $data['site_setting'] = SiteSetting::first();

        return view('Public_pages.About', $data);
    }

    public function blogs()
    {
        $data['title'] = 'blogs';
        $data['site_setting'] = SiteSetting::first();

        $data['blogs'] = Blog::where('status', 1)
        ->where('is_confirmed',1)
        ->orderBy('created_at', 'desc')
        ->take(9)->get();



        return view('Public_pages.Blogs', $data);
    }

    public function teams()
    {
        $data['title'] = 'teams';

        return view('Public_pages.Teams', $data);
    }

    public function gallery()
    {
        $data['title'] = 'gallery';
        $data['blogs'] = Blog::where('status',1)->get();
        $data['categories'] = Category::where('is_delete',0)->where('status',1)->get();


        return view('Public_pages.Gallery', $data);
    }

    public function contact()
    {
        $data['title'] = 'contact';
        $data['site_setting'] = SiteSetting::first();

        return view('Public_pages.Contact', $data);
    }
}
