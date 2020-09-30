@extends('layout')

@section('body')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        body{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        .profile{
            width: 100%;
            margin-top: 10px;
            background: #f5f5f5;
        }
        .profile .container{
            width: 80%;
            margin: 0 auto;
            display: flex;
        }
        .profile .profile__info{
            width: 27%;
            background: white;
            padding: 10px 20px;
            text-align: center;
            margin-right: 3%;
        }
        .profile .profile__info .image{
            width: 100%;
            height: 200px;
        }  
        .profile .profile__info button{
            cursor: pointer;
            margin-top: 10px;
            border: none;
            outline: none;
            background: white;
            border: 1px solid black;
            padding: 10px 60px;
            transition: .5s ease;
        } 
        .profile .profile__info button:hover{
            background: black;
            border: 1px solid black;
            padding: 10px 60px;
            color: white;
        } 
        .profile .profile__info .image img{
            width: 80%;
            height: 100%;
            object-fit: cover;
        }  
        .profile .profile__blog{
            width: 70%;
            padding: 10px 20px;
            background: white;
        }
        .profile .profile__blog .top-h1{
            border-bottom: 1px solid black;
            padding-bottom: 10px;
            font-size: 40px;
            margin-top: 0;
        }
        .profile .profile__blog .blog__wrapper{
            display: flex;
            margin-bottom: 20px;
        }
        .profile .profile__blog .blog__wrapper .image{
            width: 40%;
        }  
        .profile .profile__blog .blog__wrapper .image img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        } 
        .profile .profile__blog .blog__wrapper .content{
            width: 60%;
            padding: 10px 20px;
        }
        .profile .profile__blog .blog__wrapper .content .heading{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .profile .profile__blog .blog__wrapper .content .heading h3{
           margin-bottom: 5px;
        }
        .profile .profile__blog .blog__wrapper .content .heading button{
           outline: none;
           border: none;
           background: black;
           color: white;
           padding: 5px 10px;
           cursor: pointer;
        }
    </style>
</head>
<body>
    <section class="profile">
        <div class="container">
            <div class="profile__info">

                <div class="image">
                    <a href="{{ route('propicupdate') }}""><img src="/storage/profile_images/{{$user->profile_image}}" alt=""></a>
                </div>

                <div class="">
                    <h2>{{$user->name}}</h2>
                    <p>{{$user->phone}}</p>
                    <p>{{ $user->address }}</p>
                    <p>Email: {{$user->email}}</p>
                </div>

                <div class="">
                    <a href="{{route('userinfo.edit')}}" ><button>Edit</button></a>
                    <a href="{{route('password.edit')}}" ><button>Change Password</button></a>
                </div>

            </div>


            <div class="profile__blog">
                <div class="top-h1">My Blog </div>
                <div style="float:right"> <a href="/posts/create">Post your blog</a> </div>
        
                @foreach ($user->Posts as $post)
                    <div class="blog__wrapper">
                        <div class="image">
                            <img src="/storage/posts_images/{{$post->cover_image}}" alt="" style="width:200px; height:200px;">
                        </div>
                        <div class="content">
                            
                            <div class="heading">
                                <div class="title">
                                    <h3>{{$post->title}}</h3>
                                    <h3>Created On: {{$post->created_at}} </h3>
                                    
                                </div>
                                <div class="action">
                                    <a href="/posts/{{$post->id}}/edit"> <button>Edit</button></a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf{{--    token pathako --}}
                                        {{method_field('DELETE')}}
                                        <button style="background: red;" type="submit" class="btn btn-primary" name="delete" value="delete"> {{ __('Delete') }}</button>
                                    </form>
                                </div>
                            </div>

                            <p>{{$post->body}}</p>
                    
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
</body>
</html>
@endsection