
@extends('layout.layout')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <style>
        .owl-nav {
            top: -50px;
            position: absolute;
            margin: 0 !important;
            padding: 0 !important;
        }

        .owl-carousel .nav-button {
            height: 50px;
            width: 25px;
            cursor: pointer;
            top: 0px !important;
            background: transparent !important;
            font-size: 20px !important;
            width: fit-content;
        }

        .owl-carousel .owl-prev {
            left: 10px;
            margin: 0 !important;

        }

        .owl-nav button:hover {

            background-color: transparent !important;

        }

        .owl-carousel .owl-next {
            right: 10px;
            margin: 0 !important;
        }
        .background-img {
            transition: background-image 1s ease-in-out;
        }
    </style>
@endsection
@section('main')

    <main class="app-main container-fluid p-0">
    @php
    
                        $arry = json_decode($services->service_images)
                    @endphp
        <div class="background-img"
            style="background-image: url({{ asset($services->service_images) }});background-size: cover; ">
            <div class="row main-frame ">

                <div class="col-xl-6  text-frame  bottom-0">
                    <div class="banner-text ">
                        <h1 class="text-white text-uppercase">{{ $services->name }}</h1>
                    </div>
                </div>
                <div class="col-xl-6 sub-frame flex-column gap-10">
                  


                    <div class="row service-inquiry " style="border: 1px solid white; height:100%">
                        <div class="service-info">
                            <div class="service-description text-white">
                                Explore our exclusive collection of over 350 of the best luxury villas in Ibiza.
                                Every home in our portfolio is carefully chosen to ensure the highest standards
                                and
                                so you get the luxury vacation rental in Ibiza you have always been looking for
                            </div>
                            <div class="service-link">

                                <a href="" class="text-white rounded-0 btn explore-btn">
                                    Explore
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row  img-carousel-row " style="border: 1px solid red;">
                        <div class="owl-carousel owl-theme  image-slide">
                            @if(count($arry) > 1)
                                @forEach($arry as $image)
                                    <div class="slide-image">
                                        <img src="{{ asset($image) }}" alt="" class="img-fluid">
                                    </div>
                                @endforeach
                            @else
                                <div class="slide-image">
                                    <img src="{{ asset($arry[0]) }}" alt="" class="img-fluid">
                                </div>
                                <div class="slide-image">
                                    <img src="{{ asset($arry[0]) }}" alt="" class="img-fluid">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section id="villas" class="section-padding">
        <div class="container">
            <h2 class="section-title serif-font">Our Luxury Villas</h2>
            <div class="row">
                <!-- Villa 1 -->
                 @dd($sub_services)

                @foreach ($sub_services as $service)
                                @php
                                    $service_images = json_decode($service->service_images)
                                @endphp

                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="villa-card">
                                        <div class="villa-img-container owl-carousel">
                                            @foreach ($service_images as $image)
                                                <img src="{{ $image }}" class="villa-img img-fluid" alt="Villa Image">
                                            @endforeach
                                        </div>
                                        <div class="villa-card-body">
                                            <h3 class="villa-title">{{ $service->name }}</h3>
                                            <p class="villa-location">{{$service->service->address}}</p>
                                            <ul class="villa-features">
                                                <li><i class="fas fa-bed"></i> {{ $service->fuel_type }}</li>
                                                <li><i class="fas fa-bath"></i> {{$service->transmission}}</li>
                                                <li><i class="fas fa-swimming-pool"></i> {{$service->door}}</li>
                                                <li><i class="fas fa-utensils"></i> {{$service->agency->name}}</li>
                                            </ul>
                                            <p class="villa-price">From €1,200/night</p>
                                            <a href="#" class="btn btn-outline-dark w-100">View Details</a>
                                        </div>
                                    </div>
                                </div>
                @endforeach
                <!-- Villa 2 -->

            </div>
        </div>
    </section>
    </main>
@endsection
@section('script')


    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
        integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(function () {
            // Owl Carousel
            var owl = $(".owl-carousel");
            owl.owlCarousel({
                items: 2,
                dots: false,
                margin: 0,
                loop: true,
                nav: true,
                navText: ["<div class='nav-button d-flex owl-prev'>&larr; prev</div>", "<div class='nav-button d-flex owl-next'>next&rarr;</div>"],
                onTranslated: function(event) {
                    var currentSlide = event.item.index;
                    var totalSlides = event.item.count;
                    var backgroundImages = {!! json_encode($arry) !!};
                    var backgroundImage = backgroundImages[currentSlide % totalSlides];
                    $('.background-img').css('background-image', 'url(' + backgroundImage + ')');
                }
            });
        });

    </script>
@endsection
