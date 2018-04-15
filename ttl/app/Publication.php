<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text', 'user_id', 'date'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
