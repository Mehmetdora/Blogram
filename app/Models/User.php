<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    static public function getSingle($id)
    {
        return self::find($id);

    }

    public function profile(){
        return $this->hasOne('App\Models\Profile');
    }

    public function categories(){
        return $this->belongsToMany('App\Models\Category','profile_category')->withTimestamps();
    }

    public function blogs(){
        return $this->hasMany('App\Models\Blog');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function liked_blogs(){
        return $this->belongsToMany('App\Models\Blog','profile_blog')->withTimestamps();
    }

    public function saved_blogs(){
        return $this->belongsToMany('App\Models\Blog','saved_blogs')->withTimestamps();
    }

    public function notifications(){
        return $this->hasMany(Notification::class, 'receiver_id');
    }

    public function getProfilePhoto(){
        $user = Auth::user();
        return $user->photo;
    }
    public function getDefaultPhoto(){
        return $this->gender
            ? asset('img/Default_pfp_women.png')
            : asset('img/Default_pfp.jpg');
    }


}
