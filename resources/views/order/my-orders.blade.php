@extends('/layout')

@section('body')
    <h3>My Orders</h3>
    @foreach ($orders as $order)
        <h1>{{ $order->id }}</h1>
        <div>{{ $order->billing_total}}</div>
        @foreach ($order->items as $product)
            <div>{{ $product->name }}</div>
            <div><img src="/storage/items_images/{{$product->image}}" alt="Product image" width="200px" height="200px"></div>
        @endforeach
        <div class="spacer"></div>
    @endforeach

    <div class="spacer"></div>
@endsection