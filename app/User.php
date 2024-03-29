<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','file', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function conversations(){
        return \App\Conversation::where('user1', $this->id)->orWhere('user2', $this->id)->get();
    }

    public function messages(){
        return $this->hasMany(App\Message::class, 'user_id');
    }

    public function chat(){
        return $this->hasMany(App\Chat::class, 'user_id');
    }

    public function file(){
        return $this->hasMany(App\File::class, 'user_id');
    }
}
