<?php

namespace App\Http\Controllers;

use auth;
use App\User;
use App\Order;
use App\ItemOrder;
use Carbon\Carbon;
use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderPlacedNotification;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkout.checkout')->with([
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
    public function store(CheckoutRequest $request)
    {
       // dd($request->all());
        $user=User::where('role','admin')->first();
        //$email= $user->email;
        $contents= Cart::content()->map(function($item)
        {
          return $item->model->name.','. $item->qty;
        })->values()->toJson();

        try
        {
            $charge= Stripe::charges()->create([
                'amount'=> $this->getNumbers()->get('newTotal'),
                'currency' =>'NPR',
                'source'=> $request->stripeToken,
                'description' => 'Order',
                'receipt_email'=>$request->email,
                'metadata'=>[
                        'contents'=>$contents,
                        'quantity' => Cart::instance('default')->count(),
                        'discount' => collect( session()->get('coupon'))->toJson(),
                ],

            ]);


            $order = $this->addToOrdersTable($request,null);  //tala ko helper function call gareko 
            Mail::queue(new OrderPlaced($order));
            
            Notification::send( $user , new OrderPlacedNotification($order));
            //successful payment 

            Cart::instance('default')->destroy();
            session()->forget('coupon');
            return redirect()->route('thankyou')->with('success','Your payment has been successfully accepted! DONT forget to check your email.');
        }

        catch (CardErrorException $e)
        {
            $this->addToOrdersTable($request, $e->getMessage());  //tala ko helper function call gareko 
            return back()->with('error','Error!'. $e->getMessage());
        }
     
    }


    protected function addToOrdersTable($request, $error)  //helper function banako
    {
        $order= Order::create([
            'users_id'=> $request->user_id ,
            'billing_email'=>$request->email,
            'billing_name'=>$request->name,
            'billing_address'=>$request->address,
            'billing_phone'=>$request->phone,
            'orderDate' =>date('Y-m-d'),
            'requiredDate'=>$request->requiredDate,
            'billing_name_on_card'=>$request->name_on_card,
            'billing_discount'=>$this->getNumbers()->get('discount'), //tala ko function bata retrieve gareko ,, yo $this lekheko jati
            'billing_discount_code'=>$this->getNumbers()->get('code'),
            'billing_subtotal'=>$this->getNumbers()->get('newSubtotal'),
            'billing_tax'=>$this->getNumbers()->get('newTax'),
            'billing_total'=>$this->getNumbers()->get('newTotal'),
            'error'=>$error,        
        ]);

        //insert into pivot table
        foreach (Cart::content() as $item) 
        {
            ItemOrder::create([
                'order_id'=> $order->id,
                'item_id'=>$item->id,
                'quantity'=> $item->qty,
            ]);
        }

        return $order;

    }


    public function thankyou()
    {
        if(!session()->has('success'))
        {
            return redirect()->route('/');
        }
        return view('checkout.thankyou');
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
        //
    }

    private function getNumbers()
    {
        $tax= config('cart.tax')/100;
        $discount=session()->get('coupon')['discount'] ?? 0;
        $code=session()->get('coupon')['name']?? null;
        $Subtotal=(float) str_replace(',', '', Cart::subtotal());
        $newSubtotal=($Subtotal - $discount);
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
