<?php

namespace App\Http\Controllers;

use auth;
use App\Item;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\CheckoutController;

class CartController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.cart')->with([
            'tax' => $this->getNumbers()->get('tax'),
            'discount' => $this->getNumbers()->get('discount') ,
            'newSubtotal' => $this->getNumbers()->get('newSubtotal'),
            'newTax' => $this->getNumbers()->get('newTax'),
            'newTotal' => $this->getNumbers()->get('newTotal'),
       ]);
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

    /** cart ma dui tarika ley rakhna milcha
    
    * 1) @param   yo chai item ko food.blade.php bata aayeko request in terms of form ma 
    */ 

    public function store(Request $request)
    {
        $duplicates= Cart::search( function ($cartItem, $rowId) use($request)
        {
            return $cartItem->id === $request->id;
        });
        //print_r($duplicates);
        if($duplicates->isNotEmpty())
        {
            return redirect()->route('cart.index')->with('alreadyincart','Item is already in your cart');
        }

        Cart::add(['id'=>$request->id,'name'=> $request->name,'qty'=> 2, 'price' =>$request->price,'weight' => 1,'options'=>['image' =>$request->image, 'users_id' => auth()->user()->id ] ])->associate('App\Item');
        //Cart::store(auth()->user()->id);
        return redirect()->route('cart.index')->with('success','Cart added successfully');

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


    /** cart ma dui tarika ley rakhna milcha
    
    * 2) @param   yo chai menu ko item.blade.php bata aayeko request in terms of form ma 
    */ 

    public function edit($id)
    {
        $item= Item::find($id);
        $duplicates= Cart::search( function ($cartItem, $rowId) use($id){
            return $cartItem->id === $id;
        });
        //print_r($duplicates);
        if($duplicates->isNotEmpty())
        {
            return redirect()->route('cart.index')->with('alreadyincart','Item is already in your cart');
        }

        Cart::add(['id' => $id, 'name' => $item->name, 'qty' => 1, 'price' => $item->price, 'weight' => 1, 'options' => ['users_id' => auth()->user()->id,'image'=>$item->image] ])->associate('App\Item');

        return redirect()->route('cart.index')->with('success','Cart added successfully');
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
        Cart::update($id, $request->qty);
        return redirect()->route('cart.index')->with('success','Cart edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return redirect()->route('cart.index')->with('success','Item removed from Cart');
    }

    /**
     * Switch item from cart to Save for later
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function switchToSaveForLater($id)
    {
        $item = Cart::get($id);
        
        Cart::remove($id);

       $duplicates= Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id)
        {
            return $rowId === $id;
            
        });
        //print_r($item->options->image);
    
        if($duplicates->isNotEmpty())
        {
            return redirect()->route('cart.index')->with('alreadyincart','Item is already in your Wishlist');
        }

        Cart::instance('saveForLater')->add(['id'=>$item->id,'name'=> $item->name,'qty' => 1, 'price' =>$item->price,'weight' => 1, 'options'=>['image' =>$item->options->image, 'users_id' => auth()->user()->id ]])->associate('App\Item');

        //Cart::store(auth()->user()->id);

        return redirect()->route('cart.index')->with('success','Item added for Save For Later!');

    }

    private function getNumbers()
    {
        
        $tax= config('cart.tax')/100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $code=session()->get('coupon')['name']?? null;
        $Subtotal=(float) str_replace(',', '', Cart::subtotal());
        $newSubtotal=round($Subtotal - $discount);
        $newTax = $newSubtotal * $tax ;
        $newTotal= $newSubtotal + $newTax;   // OR  $newTotal = $newSubtotal*(1+$tax);
        
        return collect([
            'tax' => $tax,
            'discount' => $discount ,
            'code' => $code,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal,
       ]);
    }
    

}
