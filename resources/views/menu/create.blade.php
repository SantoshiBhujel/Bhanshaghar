@extends('layout')


@section('body')

<section class="signup">
    <div class="container">
        
    {{-- <div class="lg" >
        <img src="{{URL::asset('/img/lg.jpg')}}" alt="">
    </div>
--}}

    <h1>Create New MENU here !!</h1>
    <form action="{{route('menu.store')}}" method="POST" enctype="multipart/form-data">
        
        @csrf{{--    token pathako --}}
        <div class="form-group row">
            <div class="form-group col-sm-12 col-md-6">
                <label for="title">Title</label>
                <input type="text" name="name" id="name" class="form-control"  autofocus><br>
            </div>
        
            <div class="form-group col-sm-12 col-md-6">
                <label for="body">Image</label>
                <input type="file" name='image' id='image'>
            </div>
        </div>
       
        <button type="submit" class="btn btn-primary" name="post" value="submit"> {{ __('Create') }}</button>

    </form>
    </div>
</section>
@endsection