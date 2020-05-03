<?php

namespace App;

use App\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;    //db bata data delete nahune tara user ley kati bela delete gareko vanera delete_at column ma time save huncha
    protected $dates = ['deleted_at']; 

    protected $fillable= [
        'users_id',
        'orderDate',
        'requiredDate',
        'billing_email',
        'billing_name',
        'billing_address',
        'billing_city',
        'billing_province',
        'billing_postalcode',
        'billing_phone',
        'billing_name_on_card',
        'billing_discount',
        'billing_discount_code',
        'billing_subtotal',
        'billing_tax',
        'billing_total',
        'billing_gateway',
        'shipped',
        'error',        

    ];

    /** 
     * Users sanga ko relation create gareko 
     * 
    */
    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }

    /** 
     * Items sanga ko relation create gareko 
     * 
    */
    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('quantity');
    }
}
