<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class passport extends Model
{
    protected $fillable=['number'];
    
    public function Newuser()  //one to one ko reverse 
    {
        return $this->belongsTo('App\Newuser','newusers_id','id');
    }
}
