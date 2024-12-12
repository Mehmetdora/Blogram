<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class UnsignedPagesController extends Controller
{

    public function welcome()
    {
        $data['title'] = 'welcome';

        return view('Kayıtsız_Görüntülemeler.welcome',$data);
    }

    public function about()
    {
        $data['title'] = 'about';

        return view('Kayıtsız_Görüntülemeler.About', $data);
    }

    public function blogs()
    {
        $data['title'] = 'blogs';
        $data['blogs'] = Blog::where('status', 1)
        ->where('is_confirmed',1)
        ->orderBy('created_at', 'desc')
        ->take(9)->get();



        return view('Kayıtsız_Görüntülemeler.Blogs', $data);
    }

    public function teams()
    {
        $data['title'] = 'teams';

        return view('Kayıtsız_Görüntülemeler.Teams', $data);
    }

    public function gallery()
    {
        $data['title'] = 'gallery';
        $data['blogs'] = Blog::where('status',1)->get();
        $data['categories'] = Category::where('is_delete',0)->where('status',1)->get();


        return view('Kayıtsız_Görüntülemeler.Gallery', $data);
    }

    public function contact()
    {
        $data['title'] = 'contact';

        return view('Kayıtsız_Görüntülemeler.Contact', $data);
    }
}
