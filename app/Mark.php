<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $fillable=['student_id','course_id','semester_id','subject_id','exam_id','obtained_marks','total_marks'];
}
