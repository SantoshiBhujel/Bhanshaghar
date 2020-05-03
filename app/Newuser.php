<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;// soft delete garne vaye extend garnu parcha 

class Newuser extends Model
{
    
    use SoftDeletes;    //db bata data delete nahune tara user ley kati bela delete gareko vanera delete_at column ma time save huncha
    protected $dates = ['deleted_at']; 
    
   public function passport()  //"passport" class(database) sanga one to one link garako
   {
       return $this->hasOne(passport::class, 'newusers_id', 'id');
   }
   
}
 