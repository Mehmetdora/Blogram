<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['type','content','title'] ;



    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sender_name(Notification $notification){
        $sender = User::find($notification->sender_id);
        return $sender ? $sender->name :'Couldnt Find';
    }


}
