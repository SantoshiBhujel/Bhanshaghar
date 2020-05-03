<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'title','body','cover_image',];

    protected $dates = ['deleted_at']; 


    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }
}
