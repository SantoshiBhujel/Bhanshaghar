<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CouponsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon= Coupon::where('code', $request->coupon_code)->first();  

        if(!$coupon)
        {
            return redirect()->route('checkout.index')->with('error','Invalid Coupon! Please try with valid one');
        }

        // if( Auth::user()->orders->billing_discount_code == $coupon)
        // {
        //     return redirect()->route('checkout.index')->with('error','You have already used the Coupon!');
        // }
      
        session()->put('coupon',[
            'name'=> $coupon->code,
            'discount' => $coupon->discount(Cart::subtotal())
        ]);

        return redirect()->route('checkout.index')->with('success','Coupon applied');
    }

   


    /**
     * Remove the specified resource from storage.
     *
   
     * @return \Illuminate\Http\Response
     */
    
    public function delete()
    {
        session()->forget('coupon');
        return redirect()->route('checkout.index')->with('success','Coupon destroyed');

    }
    
}
