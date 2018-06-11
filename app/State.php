<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable=['state'];

    public function cities(){
    	return $this->hasMany('App\City');
    }

    public function students(){
    	return $this->hasMany('App\Student');
    }

    public function faculties(){
    	return $this->hasMany('App\Faculty');
    }


}
