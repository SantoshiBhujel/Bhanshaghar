<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class SaveForLaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::instance('saveForLater')->remove($id);

        return redirect()->route('cart.index')->with('success','Item removed from Wishlist');
    }


 /**
     * Switch from Save for Later to Cart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToCart($id)
    {
        $item = Cart::instance('saveForLater')->get($id);

        Cart::instance('saveForLater')->remove($id);
    
        $duplicates = Cart::instance('default')->search( function ($cartItem, $rowId) use($id)  
        {
            return $rowId === $id;

            // arko tarika:: 
            // use($item){
            // return $cartItem->id===$item->id;
            // }
        });

        if($duplicates->isNotEmpty())
        {
            return redirect()->route('cart.index')->with('alreadyincart','Item is already in your cart');
        }

        Cart::add(['id' => $item->id, 'name' => $item->name, 'qty' => 1, 'price' => $item->price, 'weight' => 1, 'options' => ['users_id' => auth()->user()->id,'image'=>$item->options->image] ])->associate('App\Item');
        
        return redirect()->route('cart.index')->with('success','Item has been moved to Cart');  
    }
}
