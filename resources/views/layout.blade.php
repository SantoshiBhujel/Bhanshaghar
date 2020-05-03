<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bhansha Ghar') }}</title>
    <link href="/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/css/custom.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/css/responsive.css')}}" media='screen and (max-width: 1200px)'>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/slick-theme.css')}}"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" integrity="sha256-iXUYfkbVl5itd4bAkFH5mjMEN5ld9t3OHvXX3IU8UxU=" crossorigin="anonymous" />

    @yield('extra-css')
</head>
<body> 

<header>≈
    <nav>
        <ul>
            <li><a href="/">HOME</a></li>
            <li><a href="{{route('menu.index')}}">MENU</a></a></li>
            <li><a href="restaurant.php">RESTAURANT</a></li>
            <li><a href="contact.php">CONTACT US</a></li>
            <li><a href="/posts">BLOG</a></li> 
            <li><a id="poplog" class="poplog" href="#">LOGIN</a></li>

            <ul class="navbar-nav ml-auto"> <!--pachi thapeko ho yo app.blade.php bata-->
                <!-- Authentication Links -->
                @guest
                  
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">REGISTER</a>
                        </li>
                    @endif

                    @else
                    
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ route('profile') }}"><i class="fa fa-btn fa-user"></i>
                                {{ __('Profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('posts.personal') }}"><i class="fas fa-blog"></i>
                                {{ __('Your Blogs') }}
                            </a>
                            <a class="dropdown-item" href="{{route('cart.index')}}">
                                <i class="fa fa-shopping-cart"></i>{{__('Cart')}} 
                                <span class="cart-count">
                                    @if (Cart::count()>0)
                                        <sup><span>{{ Cart::count() }}</span></sup>
                                    @endif
                                </span>
                            </a>

                            <a class="dropdown-item" href="{{route('cart.index')}}">
                                <i class="fa fa-heart" aria-hidden="true"></i>{{__('Wishlist')}} 
                                <span class="cart-count">
                                    @if (Cart::instance('saveForLater')->count()>0)
                                        <sup><span>{{ Cart::count() }}</span></sup>
                                    @endif 
                                </span>
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                           
                        </div>
                    </li>
                @endguest
            </ul>
            <!--end of  Authentication Links -->
        </ul>


        {{-- app.blade.php bata copy gareko --}}
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

    </nav>
    <div class="menu-toggle">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
</header>

<section class="h-background">
    <img src="{{URL::asset('/img/topphoto.jpg')}}" class="h-img1" alt="">
    <img src="{{URL::asset('/img/logo.jpg')}}" class="logo" alt="">
    <div class="social-media">
        <a class="sm-btn" href="#">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a class="sm-btn" href="#">
            <i class="fab fa-instagram"></i>
        </a>
        <a class="sm-btn" href="#">
            <i class="fab fa-google-plus-g"></i>
        </a>
        <a class="sm-btn" href="#">
            <i class="fab fa-twitter"></i>
        </a>
        <a class="sm-btn" href="#">
            <i class="fab fa-youtube"></i>
        </a>
    </div>    
</section>

<section class="login">
    <div class="log-box">
        <div class="close">+</div>
        <div class="lg">
            <img src="{{URL::asset('/img/lg.jpg')}}" alt="">
        </div>


        <form action="{{ route('login') }}" method="post">
            @csrf   {{-- token pathako --}}

            <label for="email">Email</label>
            
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus><br>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            
            <label for="password">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>

            <input type="submit" value="Log In"><br>

            {{-- @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif --}}

        </form>
        <p>OR</p>
        <h3>LOGIN WITH</h3>
        <div class="log-social-media">
            <button><a href="#"><i class="fab fa-facebook-f"></i> facebook</a></button>
            <button><a href="#"><i class="fab fa-google-plus-g"></i> google+</a></button>
        </div>
        <p>Don't have an account? <a href="{{route('register')}}">Signup</a></p>

        @if (Route::has('password.request'))
        <p>
            <a href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        </p>
        @endif
    </div>

</section>

{{-- header samma ko part --}}
@include('includes.alerts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js" integrity="sha256-egVvxkq6UBCQyKzRBrDHu8miZ5FOaVrjSqQqauKglKc=" crossorigin="anonymous"></script>

@yield('scripts')


@yield('body')


@yield('extra-js')




<footer class="img_wrapper">
    <div class="container">
        <div class="row">
            <div class="logo col-sm-12 col-md-3">
                <img src="{{URL::asset('/img/lg.jpg')}}" alt="">
                <h2>Bhansha Ghar</h2>
            </div>
            <div class="quick_menu col-sm-12 col-md-4">
                <h3 class="text-center">Quick Menu</h3>
                <div class="d-flex justify-content-around">
                    <div>
                        <a href="#">Foods</a>
                        <a href="#">Places</a>
                        <a href="#">Contact Us</a>
                        <a href="#">About us</a>
                        <a href="#">Trending</a>
                    </div>
                    <div>
                        <a href="#">F&Q</a>
                        <a href="#">Feedback</a>
                        <a href="#">Gallery</a>
                        <a href="#">Events</a>
                    </div>
                </div>
            </div>
            <div class="contact col-sm-12 col-md-4">
                <h3 class="text-center">Contact Us !!</h3>
                <div>
                    <p><i class="fas fa-map-marker-alt"></i> <span> Head office:</span> Kathmandu, Nepal</p>
                    <p><i class="fas fa-mobile"></i> <span> Phone number:</span> 987654321</p>
                    <p><i class="fas fa-envelope"></i> <span>Email:</span> example@gmail.com</p>
                    <p><i class="fas fa-fax"></i> <span>Fax: </span> 12346</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyright">
    <div class="container">
        <div class="row d-flex justify-content-between">
            <div class="col-12 col-md-5">
                <div class="d-flex justify-content-around">
                    <p>Copyright<i class="far fa-copyright"></i>2019</p>
                    <p><a href="#">Institute</a></p>
                    <p>All rights reserved </p>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="d-flex justify-content-around">
                    <p><a href="#">Terms of use</a></p>
                    <p><a href="#">Privacy Policy</a></p>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>     
<script src="{{URL::asset('/js/bootstrap.min.js')}}"></script>       
<script src="{{URL::asset('/js/custom.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('/js/slick.min.js')}}"></script>  
</body>
</html>  
