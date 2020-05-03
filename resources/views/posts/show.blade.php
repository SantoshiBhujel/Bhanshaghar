@extends('layout')

@section('body')
<a href="{{route('posts.index')}}"> Go Back</a>
<div class="container">
    <div class="well">
        <div class="media">
            <a class="pull-left" href="#">
            <img style="width:20%" src="/storage/posts_images/{{!empty($posts->cover_image)? $posts->cover_image:''}}">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{$posts->title}}</h4></h4>
            <p class="text-right">By {{$posts->user->name}}</p>
                <p>
                    {{$posts->body}}
                </p>
                <ul class="list-inline list-unstyled">
                    <li><span><i class="glyphicon glyphicon-calendar"></i> Written on {{$posts->created_at}} </span></li>
                    <li>|</li>
                    <span><i class="glyphicon glyphicon-comment"></i> 2 comments</span>
                    <li>|</li>
                    <li>
                        <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                    </li>
                    <li>|</li>
                    <li>
                    <!-- Use Font Awesome http://fortawesome.github.io/Font-Awesome/ -->
                        <span><i class="fa fa-facebook-square"></i></span>
                        <span><i class="fa fa-twitter-square"></i></span>
                        <span><i class="fa fa-google-plus-square"></i></span>
                    </li>
                </ul>
                
            </div>
        </div>
    </div>
</div>
@endsection