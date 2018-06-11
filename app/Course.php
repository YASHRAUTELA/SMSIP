<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable=['course_name','duration'];

    public function students(){
    	return $this->hasMany('App\Student','course_id','id');
    }

    public function semesters(){
    	return $this->hasMany('App\Semester','course_id','id');
    }
}
