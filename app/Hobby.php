<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    public function user(){ //singular, because one to many
        return $this->belongsTo('App\User');
    }

    public function tags(){ 
        return $this->belongsToMany('App\Tag');
    }

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'name', 'description',
   ];
}
