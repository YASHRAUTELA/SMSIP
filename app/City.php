<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable=['city,state_id'];

    public function state(){
    	return $this->belongsTo('App\State');
    }

    public function students(){
    	return $this->hasMany('App\Student');
    }

    public function faculties(){
    	return $this->hasMany('App\Faculty');
    }
}
