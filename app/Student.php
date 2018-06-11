<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable=['user_id','father_name','mother_name','course_id','contact','city_id','state_id','address','registration_date','session','pin'];
    
    public function user(){
    	return $this->belongsTo('App\User','user_id','id');
    }

    public function course(){
    	return $this->belongsTo('App\Course','course_id','id');
    }

    public function city(){
    	return $this->belongsTo('App\City');
    }

    public function state(){
    	return $this->belongsTo('App\State');
    }
}
