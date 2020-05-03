<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ActivationCode extends Model
{
    //
    protected $fillable = ['code'];
    
    public function User()
    {
        return $this->belongsTo(User::class,'users_id');
    }

    public function getRouteKeyName()
    {
        return 'code';
    }

}
