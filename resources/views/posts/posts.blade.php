@extends('layout')

@section('body')


    <h1>ALL BLOGS HERE</h1>
    @if (Auth::user())
    <a href="/posts/create">Post your blog</a> 
    @endif
    @if(count($posts)>0)
        @foreach ($posts as $post)
            <div class="well">

                <blockquote class="blockquote text-center">

                    <a href="/posts/{{$post->id}}"> <h4 class="mb-0">{{$post->title}}</h4> </a>
                    
                        <img style="width:20%" class="pull-left" src="/storage/posts_images/{{!empty($post->cover_image)? $post->cover_image:''}}">
                    <footer class="blockquote-footer">
                            {{$post->body}}
                        <br>
                        <small>Written on {{$post->created_at}}</small>
                        <br>
                        <small>By {{!empty($post->user) ? $post->user->name:''}}</small> 
                        {{-- incase written by ko user vetiyena vane yo use garne, if user compulsory cha vane can use {{$post->user->name}} --}}
                    </footer>
                    @if(Auth::user()->role=='admin')
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf{{--    token pathako --}}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-primary" name="delete" value="delete"> {{ __('Delete') }}</button>
                        </form>
                    @endif
                </blockquote>
            </div>
             
        @endforeach

    @else
        <p>
            No Posts Available
        </p>
    @endif

@endsection