<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','image_title','dob','verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function student(){
        return $this->hasOne('App\Student','user_id','id');
    }

    public function faculty(){
        return $this->hasOne('App\Faculty');
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function verifyUser(){
        return $this->hasOne('App\VerifyUser'); 
    }
}
