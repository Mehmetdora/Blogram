<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $table = 'site_settings';



    public function editors_blog($editors_pick_blog_id){

        $blog = Blog::find($editors_pick_blog_id);
        return $blog->title;

    }





}
