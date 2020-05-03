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
        .profile .profile__blog .blog__wrapper .content .heading h1{
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
                    <img src="/storage/profile_images/{{$user->profile_image}}" alt="">
                </div>

                <div class="">
                    <h2>{{$user->name}}</h2>
                    <p>{{$user->phone}}</p>
                    <p>Email: {{$user->email}}</p>
                </div>

                <div class="">
                    <a href="{{route('userinfo.edit')}}" target="#" ><button>Edit</button></a>
                    {{-- <iframe height="300px" width="100%" src="" name="iframe_a"></iframe> --}}
                </div>

            </div>


            <div class="profile__blog">
                <h1 class="top-h1">My Blog</h1>
                <div class="blog__wrapper">
                    
                    @foreach ($posts as $post)
                            <div class="image">
                                <img src="/storage/cover_images/{{$post->cover_image}}" alt="">
                            </div>
                            <div class="content">
                                
                                <div class="heading">
                                    <div class="title">
                                        <h1>{{$post->title}}</h1>
                                        <span>Date: {{$post->created_at}} </span>
                                    </div>
                                    <div class="action">
                                        <button>Edit</button>
                                        <button style="background: red;">Delete</button>
                                    </div>
                                </div>

                                <p>{{$post->body}}</p>
                        
                            </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
</body>
</html>
@endsection