@extends('layout')

@section('body')

<section class="signup">
    <div class="container">

    <h1>Edit ITEM here !!</h1>
    <form action="{{route('item.update', $item->id)}}" method="POST" enctype="multipart/form-data">
        
        @csrf{{--    token pathako --}}
        {{method_field('PATCH')}}
        <div class="form-group row">
            <div class="form-group col-sm-12 col-md-6">
                <label for="title">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $item->name }}" autofocus><br>
            </div>
        
            <div class="form-group col-sm-12 col-md-6">
                <label for="title">Price</label>
                <input type="text" name="price" id="price" class="form-control" value="{{ $item->price }}"><br>
            </div>
        </div>
       
        <div class="form-group row">
            <div class="form-group col-sm-12 col-md-6">
                <label for="title">Menu Type</label>
                <select name="menus_id" required>
                    @foreach($menus as $menu)
                        <option value="{{$menu->id}}">
                        {{$menu->name}}
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="post" value="submit"> {{ __('Update') }}</button>

    </form>
    </div>
</section>

@endsection