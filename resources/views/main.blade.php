@extends('/layout')

@section('body')
<section class="quick_menu">
    <h2 class="title">Quick Menu</h2>
    <div class="container quick_menu-slider">
        <div class="item"><a href="{{ route('item.index') }}"><img src="{{ URL::asset('/img/momo.jpg') }}" alt=""></a></div>
        <div class="item"><a href="food.php"><img src="{{URL::asset('/img/chicken.png')}}" alt=""></a></div>
        <div class="item"><a href="food.php"><img src="{{URL::asset('/img/burger.png')}}" alt=""></a></div>
        <div class="item"><a href="food.php"><img src="{{URL::asset('/img/chowmin.png')}}" alt=""></a></div>
        <div class="item"><a href="food.php"><img src="{{URL::asset('/img/drinks.png')}}" alt=""></a></div>
        <div class="item"><a href="food.php"><img src="{{URL::asset('/img/pizza.png')}}" alt=""></a></div>
        <div class="item"><a href="food.php"><img src="{{URL::asset('/img/softdrink.png')}}" alt=""></a></div>
    </div>
</section>

<section class="trending">

<section class="quick_menu">
    <div class="container">
        <h2 class="title">Trending Dishes in Valley</h2>
        <div class="row">
            <div class="trending_item col-sm-12 col-md-6">
                <a href="">
                    <img src="{{URL::asset('/img/d1.jpg')}}" alt="">
                    <div class="read-hover d-flex flex-column justify-content-center align-items-center">
                        <i class="fab fa-readme"></i>
                        <p>Read More</p>
                    </div>
                    <div class="info">
                        <h4>Bajeko Sekuwa</h4>
                        <span>Behind Police Headquatar, Kathmandu</span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, vitae.</p>
                    </div>
                </a>
            </div>
            <div class="trending_item col-sm-12 col-md-6">
                <a href="">
                    <img src="{{URL::asset('/img/d2.jpg')}}" alt="">
                    <div class="read-hover d-flex flex-column justify-content-center align-items-center">
                        <i class="fab fa-readme"></i>
                        <p>Read More</p>
                    </div>
                    <div class="info">
                        <h4>Crust Pizza</h4>
                        <span>Baneshwor, Kathmandu</span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, vitae.</p>
                    </div>
                </a>
            </div>
            <div class="trending_item col-sm-12 col-md-6">
                <a href="">
                    <img src="{{URL::asset('/img/d3.png')}}" alt="">
                    <div class="read-hover d-flex flex-column justify-content-center align-items-center">
                        <i class="fab fa-readme"></i>
                        <p>Read More</p>
                    </div>
                    <div class="info">
                        <h4>KFC - Maitidevi</h4>
                        <span>Maitidevi</span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, vitae.</p>
                    </div>
                </a>
            </div>
            <div class="trending_item col-sm-12 col-md-6">
                <a href="">
                    <img src="{{URL::asset('/img/d4.png')}}" alt="">
                    <div class="read-hover d-flex flex-column justify-content-center align-items-center">
                        <i class="fab fa-readme"></i>
                        <p>Read More</p>
                    </div>
                    <div class="info">
                        <h4>Thai Ghar</h4>
                        <span>Jhamshikhel, opposite of MOKSHA, Lalitpur</span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, vitae.</p>
                    </div>
                </a>
            </div>
        </div>

    </div>
</section>
    
@endsection