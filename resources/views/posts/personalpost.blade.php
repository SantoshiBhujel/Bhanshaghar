@extends('layout')

@section('body')

    <div style="align:center"> <h1><i class="fas fa-blog"> </i> BLOGS </h1></div>

    @if(count($posts)>0)
    <a href="/posts/create">Post your blog</a>
        @foreach ($posts as $post)
            @can('view-post',$post)
            <div class="well">

                <blockquote class="blockquote text-center">

                    <a href="/posts/{{$post->id}}"> <h4 class="mb-0">{{$post->title}}</h4> </a>
                    <img style="width:20%" src="/storage/posts_images/{{!empty($post->cover_image)? $post->cover_image:''}}">
                    <footer class="blockquote-footer">
                            {{$post->body}}
                        <br>
                        <small>Written on {{$post->created_at}}</small>
                        <br>
                        {{-- <small>Written by {{!empty($post->user) ? $post->user->name:''}}</small>  --}}
                        {{-- incase written by ko user vetiyena vane yo use garne, if user compulsory cha vane can use {{$post->user->name}} --}}
                    </footer>
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
                {{-- <a href="/posts/{{$posts->id}}/delete" class="btn btn-default">Delete</a> --}}
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf{{--    token pathako --}}
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-primary" name="delete" value="delete"> {{ __('Delete') }}</button>
                </form>
                </blockquote>
                
            </div>
            @endcan
        @endforeach

        @else
        <p>
           <small>When you share posts they'll appear here!</small> 
           <br>
            <a href="/posts/create">Share your first blog here</a>  
        </p>
   @endif

@endsection