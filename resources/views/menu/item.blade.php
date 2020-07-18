@extends('layout')
@section('css')
    
@endsection
@section('body')
    <div style="width:300px; float:right">
        @include('items.search')
    </div>
    <section class="menu">
        <div class="container"></div>
        <h1 class="item-heading">{{ $name }}</h1>
            <div class="row d-flex justify-content-around flex-wrap">
                @foreach ($items as $item)
                <div class="menu-box col-sm-12 col-md-3">
                    
                        <h4>{{$item->name}}</h4>
                        <ul>
                            <img src="/storage/items_images/{{$item->image}}" alt="">
                            <sup> NPR </sup>{{$item->price}}</<sup>
                        </ul>
                        @if (Auth::user())
                            <a href="{{route('cart.edit',$item->id)}}"><button><i class="fa fa-shopping-cart"></i>Add to Cart</button></a>

                            @if(Auth::user()->role=='admin')
                                <a href="{{route('item.edit',$item->id)}}"><button>Edit</button></a>
                            @endif
                        @endif
                </div>
                @endforeach
            </div>
        
        </div>
    </section>

@endsection