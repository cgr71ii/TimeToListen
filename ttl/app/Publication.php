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

        /*
         * Si se quiere que la funcion se llame diferente a la convencion utilizada por Laravel:
         * 
         * public function user_publish(){
         *      return $this->belongsTo('App\User', 'user_id');
         * }
         */

        return $this->belongsTo('App\User');

    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
