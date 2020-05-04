@extends('layout')

@section('body')
    @if(Cart::count()>0)
    
        <section class="signup">
            <p>{{Cart::count()}} Item(s) in your cart </p>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Users Id</th>
                        <th>Action</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
        
                <tbody>
        
                    @foreach(Cart::content() as $row)
        
                        <tr>
                            <td><img src="/storage/items_images/{{$row->options->has('image') ? $row->options->image : '' }}" alt=""  ></td>
                            <td>
                                <p><strong>{{ $row->name  }}</strong></p>
                            </td>
                            <td>{{$row->options->has('users_id') ? $row->options->users_id : '' }}</td>
                            <td>
                                
                                <form action="{{route('cart.destroy',$row->rowId)}}" method="POST">
                                    {{method_field('DELETE')}}
                                    @csrf
                                    <button type="submit">Remove</button>                                
                                </form>

                                <form action="{{route('cart.To.saveForLater',$row->rowId)}}" method="POST">
                                   
                                    @csrf
                                    <button type="submit">Move to Wishlist</button>                                
                                </form>
                                
                            </td>
                            <td width="100px">
                                <form action="{{route('cart.update',$row->rowId)}}" method="POST">
                                    @csrf
                                    {{method_field('PUT')}}

                                <input type="text" name="qty" id="" value="{{$row->qty}}">
                                
                                <input type="submit" value="OK">
                                </form>
                            </td>
                            <td><sup> NPR </sup>{{$row->price}}</td>
                            <td><sup> NPR </sup>{{ $row->total }} </td>
                        </tr>
        
                    @endforeach
        
                </tbody>
                        
           
                <tfoot>
                    <tr>
                        <td colspan="5">&nbsp;</td>
                        <td>Subtotal:</td>
                        <td><?php echo Cart::subtotal(); ?></td>
                    </tr>
                    
                    
                    @if (session()->has('coupon'))
                    <tr>
                        <td colspan="5">&nbsp;</td>
                        <td>Discount ({{ session()->get('coupon')['name'] }}):</td>
                        <td>-{{ $discount }}</td>
                    </tr>
                    <tr>
                        <td colspan="5">&nbsp;</td>
                        <td>SubTotal after discount:</td>
                        <td>{{ $newSubtotal }}</td>
                    </tr>
                    @endif

                    <tr>
                        <td colspan="5">&nbsp;</td>
                        <td>Tax({{config('cart.tax')}}%)):</td>
                        <td>{{ $newTax }}</td>
                    </tr>
                    <tr>
                        <td colspan="5">&nbsp;</td>
                        <td>Total:</td>
                        <td>{{ $newTotal }}</td>
                    </tr>
                </tfoot>
        </table>
        @if(! session()->has('coupon'))
        <a href="">Have a code?</a>
        <section class="signup">
            <div class="left">
                <form action="{{ route('coupons.store') }}" method="POST">
                @csrf
                    <div class="form-group row">
                        <div class="form-group col-sm-6 col-md-6">
                        <input type="text" name="coupon_code" id="coupon_code">
                        </div>
                    </div>
                <button type="submit" value="">Apply</button>
                </form>
            </div>
        </section>
    @endif
        </section>
        @else
            <h2>No Items in Your Cart</h2>
        @endif


    @if(Cart::instance('saveForLater')->count()>0)
    <p>{{Cart::instance('saveForLater')->count()}} Item(s) in your Wishlist </p>
    <section class="signup">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                  
                    <th>Action</th>
                  
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
    
            <tbody>
        
                @foreach(Cart::instance('saveForLater')->content() as $row)
                     
                    <tr>
                        <td><img src="/storage/items_images/{{$row->options->has('image') ? $row->options->image : '' }}" alt=""  ></td>
                        <td>
                            <p><strong>{{ $row->name  }}</strong></p>
                        </td>
                        
                        <td>
                           
                            <form action="{{route('saveForLater.destroy',$row->rowId)}}" method="POST">
                                {{method_field('DELETE')}}
                                @csrf
                                <button type="submit">Remove</button>                                
                            </form>

                        
                            <form action="{{route('wishlist.To.cart',$row->rowId)}}" method="POST"> 
                                @csrf
                                <button type="submit">Move to Cart</button>                                
                            </form>
                            
                        </td>
                        
                        <td><sup> NPR </sup>{{$row->price}}</td>
                        <td><sup> NPR </sup>{{ $row->total }} </td>
                    </tr>
    
                @endforeach
    
            </tbody>
            
        </table>
    </section>
    @else
        <h2>No Items in Your Wishlist</h2>
    @endif
    @if(Cart::instance('default')->count()>0)
    
        <div class="cart-buttons"> <a href="{{ route('checkout.index') }}"> Proceed to Checkout</a></div>
    @endif
@endsection