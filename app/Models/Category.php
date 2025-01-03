<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','status','is_delete'];

    public function user()
    {
        return $this->belongsToMany('App\Models\User','profile_category')->withTimestamps();
    }

    public function isAdded(Category $category) {
        $user = Auth::user();
        $user_categories = $user->categories;
        foreach($user_categories as $myCategory){
            if($category->id == $myCategory->id){
                return true;
            }
        }
    }

    static function getRecord(){    // eğer self ile erişim sağlıyorsan static olarak oluşturulmalı

        $categories = self::where('is_delete',0)->orderBy('created_at','desc')->paginate(10);
        return $categories;

    }

}
