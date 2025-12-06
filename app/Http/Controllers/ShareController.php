<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function blog_share($blog_id)
    {
        $blog = Blog::where('id', $blog_id)
            ->where('status', 1)
            ->where('is_confirmed', 1)
            ->first();

        if (! $blog) {
            abort(404);
        }
        $data['blog'] = $blog;


        return view('Public_pages.share_preview', $data);
    }
}
