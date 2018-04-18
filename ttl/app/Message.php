<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['user_id', 'title', 'text', 'read', 'date'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function user_receive(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
