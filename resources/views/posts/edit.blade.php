@extends('layout')

@section('body')
    
<section class="signup">
    <div class="container">
        
        {{-- <div class="lg" >
            <img src="{{URL::asset('/img/lg.jpg')}}" alt="">
        </div>
 --}}
        <h1>Update Your POST here !!</h1>
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            
            @csrf{{--    token pathako --}}
            {{method_field('PUT')}}
            <div class="form-group row">
                <div class="form-group col-sm-12 col-md-6">
                    <label for="title">Title</label>
            
                    <input type="text" name="title" id="title" value= '{{$post->title}}' class="form-control"  autofocus><br>
                   
                </div>
            
                <div class="form-group col-sm-12 col-md-6">
                    <label for="body">Body</label>
                    <textarea name="body" id="body" cols="35" rows="10" value= '{{$post->body}}' class="form-control"></textarea>
                </div>
                
                <div class="form-group col-sm-12 col-md-6">
                    <label for="body">Cover Image</label></label>
                    <input type="file" name='cover_image' id='cover_image'>
                </div>
            </div>
           
            <button type="submit" class="btn btn-primary" name="post" value="submit"> {{ __('Edit') }}</button>

        </form>
        
    </div>

</section>

@endsection