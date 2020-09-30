@extends('layout')
   
@section('body')
<div >
    @if (Auth::user())
        @if (Auth::user()->role=='admin')
        <a href="{{route('item.create')}}"><button>Insert New Item</button></a>
        @endif
    @endif
    
    <div style="width:300px; float:right">
        @include('items.search')
    </div>
</div>
    <h1 class="text-center">All Items Here  </h1>
    
   
    <section class="menu">
        <div class="container">

            <div class="row d-flex justify-content-around flex-wrap">
                @foreach ($items as $item)
                    <div class="menu-box col-sm-12 col-md-3">
                    
                        <h4>{{$item->name}}</h4>
                        <ul>
                            <img src="/storage/items_images/{{$item->image}}" alt="">
                            <sup> NPR </sup>{{$item->price}}</<sup>
                        </ul>
                        
                        @if (Auth::user()->role=='user')
                            <section class="cart">

                                <form  action="{{route('cart.store')}}" method="post">
                                    @csrf
                                    <input name="id" type="hidden" class="form-control" value="{{$item->id}}" >
                                    <input name="name" type="hidden" class="form-control" value="{{$item->name}}" >
                                    <input name="price" type="hidden" class="form-control" value="{{$item->price}}" >
                                    <input name="image" type="hidden" class="form-control" value="{{$item->image}}" >
                                    <button type="submit" class="btn btn-primary" name="signup">{{ __('Add To cart') }}</button>
                                </form>

                            </section>
                            {{-- <a href="{{route('cart.store',$item->id)}}"><button><i class="fa fa-shopping-cart"></i>Add to Cart</button></a> --}}
                        @endif
                        @if(Auth::user()->role=='admin')
                            <a href="{{route('item.edit',$item->id)}}"><button>Edit</button></a>
                        @endif
                    </div>
                @endforeach
                
            </div>

            <div class="row">
                <div class="col-12 d-flex justify-content-center pt-4">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
        
    </section>
   
@endsection