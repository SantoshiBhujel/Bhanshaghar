@component('mail::message')
Hello  {{ $order->user->name }}
<p>
Thank you for your order. <br>
Your payment has been done successfully with amount of NPR {{ round($order->billing_total,2) }}. 
</p>

**Order ID:** {{ $order->id }} <br>
**Order Email:** {{ $order->billing_email }} <br>
**Order Billing Name:** {{ $order->billing_name }} 
<br>
**Order Total:** {{ round($order->billing_total,2) }}

**Items Ordered**
<br>
@foreach ($order->items as $item )
    Name: {{ $item->name }} <br>
    Price: {{ round($item->price,2) }} <br>
    Quantity: {{ $item->pivot->quantity }} <br >
<br><br>
@endforeach
@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Keep ordering to get more discounts and offers!!
Thanks,<br>
{{ config('app.name') }}
@endcomponent
