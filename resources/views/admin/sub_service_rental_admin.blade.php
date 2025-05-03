@extends('layout.layout')

@section('main')
<div class="container-fluid">
    <div class="background-img" style="background-image: url();background-size: cover;">
        <div class="row main-frame">
            <div class="col-xl-6 text-frame bottom-0">
                <div class="banner-text">
                    <h1 class="text-white text-uppercase"></h1>
                </div>
            </div>
            <div class="col-xl-6 sub-frame flex-column gap-10">
                <div class="row service-inquiry" style="border: 1px solid white; height:100%">
                    <div class="service-info">
                        <div class="service-description text-white">
                            Explore our exclusive collection of over 350 of the best luxury villas in Ibiza. Every home in our portfolio is carefully chosen to ensure the highest standards and so you get the luxury vacation rental in Ibiza you have always been looking for
                        </div>
                        <div class="service-link">
                            <a href="" class="text-white rounded-0 btn explore-btn">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="row img-carousel-row" style="border: 1px solid red;">
                    <div class="owl-carousel owl-theme image-slide">
                        <div class="slide-image">
                            <img src="" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection