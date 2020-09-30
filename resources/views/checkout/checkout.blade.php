@extends('layout')

@section('extra-css')
    <script src="https://js.stripe.com/v3/"></script>
@endsection



@section('body')


  <h1 >Checkout</h1>
  <section class="signup">
    <div class="container">
      <div class="left">
        <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">

         @csrf

          <h2>Billing Details</h2>

          <div class="form-group row">
            <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}" required>

            <div class="form-group col-sm-6 col-md-6">
              <label for="email">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
            </div>

            <div class="form-group col-sm-6 col-md-6">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{auth()->user()->name }}" required>
            </div>

          </div>

          <div class="form-group row">
            <div class="form-group col-sm- col-md-6">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" name="address" value="{{ auth()->user()->address }}" required>
            </div>

          
            <div class="form-group col-sm- col-md-6">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}" required>
            </div>
          </div> 

          <div class="form-group row">
            <div class="form-group col-sm- col-md-6">
              <label for="address">Required Date + T ime</label>
              <input type="datetime-local" class="form-control" id="requiredDate" name="requiredDate" required value="<?php date('Y-m-d\TH:i ', time()); ?>">
            </div>

          </div> 
          <h2>Payment Details</h2>

          <div class="form-group">
              <label for="name_on_card">Name on Card</label>
              <input type="text" class="form-control" id="name_on_card" name="name_on_card" required>
          </div>

          <div class="form-group">
              <label for="card-element">
                Credit or debit card
              </label>
              <div id="card-element">
                <!-- a Stripe Element will be inserted here. -->
              </div>

              <!-- Used to display form errors -->
              <div id="card-errors" role="alert"></div>
          </div>
          <button type="submit" name="complete-order" id="complete-order">Complete Order</button>
        </form>

            {{-- @if ($paypalToken) 
                <div class="mt-32">or</div>
                <div class="mt-32">
                    <h2>Pay with PayPal</h2>

                    <form method="post" id="paypal-payment-form" action="{{ route('checkout.paypal') }}">
                        @csrf
                        <section>
                            <div class="bt-drop-in-wrapper">
                                <div id="bt-dropin"></div>
                            </div>
                        </section>

                        <input id="nonce" name="payment_method_nonce" type="hidden" />
                        <button class="button-primary" type="submit"><span>Pay with PayPal</span></button>
                    </form>
                </div>
            @endif --}}
      </div>{{--  end of left --}}
       
  

      <div class="checkout-right">
          <h2>Your Order</h2>

          @foreach (Cart::content() as $item)  
            <img style="height=150px; width=150px;" src="/storage/items_images/{{$item->model->image}}" alt="item">
            <div>
                <div ></div>Item: {{ $item->model->name }}</div>
                <div ></div>
                <div >Price: {{ $item->model->price }}</div>
                <div > Qty: {{ $item->qty }}</div>
            </div>
          @endforeach
          <hr>
          Subtotal:  {{ Cart::subtotal()}} <br>

          @if (session()->has('coupon'))
              Discount ({{ session()->get('coupon')['name'] }})

              <form action="{{ route('coupons.delete','') }}" method="POST" style="display:inline">
                @csrf
                {{ method_field('post') }}
                <button style="font-size:12px">Remove</button>
              </form> : 

               -{{ $discount }}  {{--discount  amount --}}
              <br>
              <hr>
              New Subtotal :  {{ $newSubtotal }}<br>
          @endif
          <hr>
          Tax ({{config('cart.tax')}}%):  {{ $newTax }}<br>
          <span>Total:  {{ $newTotal }}</span>
      </div>
    </div>   
  </section> 

@endsection


@section('extra-js')  

    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>

    
    <script>
        (function(){//stripe.com/docs/stripe-js#html-js    bata copy gareko portion

          // Create a Stripe client
          var stripe = Stripe('pk_test_NDShK1ITLYMYvB9zP5RnpbGG00bTXTjyyz');  //stripe ko API key 
          
          // Create an instance of Elements
          var elements = stripe.elements();
          
          // Custom styling can be passed to options when creating an Element.
          // (Note that this demo uses a wider set of styles than the guide below.)
          
          var style = {
            base: {
              color: '#32325d',
              lineHeight: '18px',
              fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif', 
              fontSmoothing: 'antialiased',
              fontSize: '16px',
              '::placeholder': {
                color: '#aab7c4'
              }
            },
            invalid: {
              color: '#fa755a',
              iconColor: '#fa755a'
            }
          };


          // Create an instance of the card Element
          var card = elements.create('card', {style: style,  hidePostalCode: true });


          // Add an instance of the card Element into the `card-element` <div>
          card.mount('#card-element');


          // Handle real-time validation errors from the card Element.
          card.addEventListener('change', function(event) 
          {
            var displayError = document.getElementById('card-errors');
            if (event.error) 
            {
              displayError.textContent = event.error.message;
            } 
            else 
            {
              displayError.textContent = '';
            }
          });


          // Handle form submission
          var form = document.getElementById('payment-form');

          form.addEventListener('submit', function(event) 
          {
            event.preventDefault();

            // Disable the submit button to prevent repeated clicks
            document.getElementById('complete-order').disabled = true;

            var options = { //documentation ley recommend gareko field ko object banako // js ma chaina afai thapeko ho

              name: document.getElementById('name_on_card').value,
              address_line1: document.getElementById('address').value,
              // address_city: document.getElementById('city').value,
              // address_state: document.getElementById('province').value,
              // address_zip: document.getElementById('postalcode').value
            }

            stripe.createToken(card, options).then(function(result) { //banako object yesma pass gareko

              if (result.error) 
              {
                // Inform the user if there was an error
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                 
                // Enable the submit button
                document.getElementById('complete-order').disabled = false;
              }

              else 
              {
                // Send the token to your server
                stripeTokenHandler(result.token);
              }
            });
          }); //end of form

          // Submit the form with the token ID.
          function stripeTokenHandler(token) 
          {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');  //mathi ko payment form ko id payment-form ho 
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
          }
          // ya samma stripe.js bata JavaScript copy gareko 
            


            // PayPal Stuff
            var form = document.querySelector('#paypal-payment-form');
            var client_token = "{{ $paypalToken ?? '' }}";
            braintree.dropin.create({
              authorization: client_token,
              selector: '#bt-dropin',
              paypal: {
                flow: 'vault'
              }
            }, function (createErr, instance) {
              if (createErr) {
                console.log('Create Error', createErr);
                return;
              }
              // remove credit card option
              var elem = document.querySelector('.braintree-option__card');
              elem.parentNode.removeChild(elem);
              form.addEventListener('submit', function (event) {
                event.preventDefault();
                instance.requestPaymentMethod(function (err, payload) {
                  if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                  }
                  // Add the nonce to the form and submit
                  document.querySelector('#nonce').value = payload.nonce;
                  //form.submit();
                });
              });
            });
        })();
    </script>
@endsection