@extends('layout')


@section('body')
    @if (Auth::user())
        @if (Auth::user()->role=='admin')
            <a href="{{route('menu.create')}}"><button>Create New Menu</button></a>
        @endif
    @endif
    

    <a href="{{route('item.index')}}"><button>See All Items</button></a>
    <div style="width:300px; float:right">
        @include('items.search')
    </div>
    <h1 class="text-center">Today's Menu</h1>
   
    <section class="menu">
        <div class="container">

            <div class="row d-flex justify-content-around flex-wrap">
                @foreach ($menus as $menu)
                <div class="menu-box col-sm-12 col-md-3">
                    
                    <a href="{{route('item.show',$menu->id)}}"><h4>{{$menu->name}}</h4></a>
                        <ul>
                            
                            <a href="{{route('item.show',$menu->id)}}"><img src="/storage/menu_images/{{$menu->image}}" alt=""></<img> 
                        </ul>
                  
                </div>
                @endforeach
            </div>
           
        </div>
    </section>
    
@endsection