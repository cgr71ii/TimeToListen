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
        'email', 'password', 'name', 'lastname', 'birthday', 'pic_profile_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userHasFriends()
    {
        return $this->belongsToMany('App\User', 'user_user', 'user_id', 'user_friend_id');
    }

    public function userIsFriendOf()
    {
        return $this->belongsToMany('App\User', 'user_user', 'user_friend_id', 'user_id');
    }

}
