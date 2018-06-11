<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function state(){
    	return $this->belongsTo('App\State');
    }

    public function city(){
    	return $this->belongsTo('App\City');
    }

    public function departments(){
    	return $this->belongsTo('App\Department');
    }
}
