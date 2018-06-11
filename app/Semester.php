<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable=['semester','course_id'];

    public function course(){
    	return $this->belongsTo('App\Course','course_id','id');
    }
}
