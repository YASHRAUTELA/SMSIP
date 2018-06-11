<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $fillable=['name','email','password','image_title','role_id','status',];
}
