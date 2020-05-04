<?php

namespace App\Listeners;


use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Coupon;
use App\Jobs\UpdateCoupon;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        $couponName= session()->get('coupon')['name'];  

        if($couponName)
        {
            $coupon= Coupon::where('code',$couponName)->first();

            // session()->put('coupon',[
            //     'name'=> $coupon->code,
            //     'discount' => $coupon->discount(Cart::subtotal())
            // ]);   

            //above task was done using the job
            dispatch_now(new UpdateCoupon($coupon));
        } 
    }
}
