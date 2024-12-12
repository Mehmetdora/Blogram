<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['blog_id', 'blog_photo'];
    protected $table = 'blog_photo';

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
