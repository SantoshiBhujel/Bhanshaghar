<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    protected $table= 'item_order';

    protected $fillable= [
        'order_id',
        'item_id', 
        'quantity',
    ];
}
