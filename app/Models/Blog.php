<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'title',
        'description',
        'like_count',
        'save_count',
        'comment_count',
        'category'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function liked_users()
    {
        return $this->belongsToMany('App\Models\User', 'profile_blog')->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany(BlogPhoto::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function savedBy_users()
    {
        return $this->belongsToMany('App\Models\User', 'saved_blogs')->withTimestamps();
    }






    public function get_category(Blog $blog)
    {
        $category = Category::find($blog->category_id);
        return $category->name;
    }

    public function get_count_using_category(Category $category){
        $blogs = Blog::where('category_id',$category->id)->where('status',1)->get();
        return count($blogs);
    }

    public function get_blog_user(Blog $blog){
        $user = User::find($blog->user_id);
        return $user;
    }
}
