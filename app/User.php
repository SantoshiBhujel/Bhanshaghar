<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active','address','phone','profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** 
     * ActivationCode sanga ko relation create gareko 
     * 
    */
    public function ActivationCode(){
        return $this->hasOne(ActivationCode::class,'users_id');
    }


    public function userIsActivated(){ //helper function
        if($this->active){
            return true;
        }
        return false; 
    }
    /** 
     * Posts sanga ko relation create gareko 
     * 
    */
    public function Posts()
    {
        return $this->hasMany(Post::class,'users_id');
    }
    /** 
     * Posts sanga ko relation create gareko 
     * EUta user ko one or more orders huna sakcha
    */
    public function orders()
    {
        return $this->hasMany(Order::class,'users_id');
    }
     
}
