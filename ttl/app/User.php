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
        'email', 'password', 'name', 'lastname', 'birthday', 'pic_profile_path', 'song_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_user', 'user_id', 'user_friend_id')->withTimestamps();
    }

    public function userFriends()
    {
        return $this->belongsToMany('App\User', 'user_user', 'user_friend_id', 'user_id')->withTimestamps();
    }

    public function publication()
    {
        return $this->hasMany('App\Publication');
    }

    public function message()
    {
        return $this->hasMany('App\Message');
    }

    public function message_user()
    {
        return $this->belongsToMany('App\Message')->withTimestamps();
    }

    public function group_user()
    {
        return $this->belongsToMany('App\Group')->withTimestamps();
    }

    public function song()
    {
        return $this->hasMany('App\Song');
    }

    public function song_status()
    {
        return $this->belongsTo('App\Song', 'song_id');
    }

}
