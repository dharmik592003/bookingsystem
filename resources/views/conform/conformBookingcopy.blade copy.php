@extends('layout.layout')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
@endsection

@section('main')
    <div class="row">
        <div class="col-xl-6 service-booking">
            @include('partials.booking-form', ['services' => $services, 'user' => $user, 'stay' => $stay])
        </div>
        <div class="col-xl-6 align-content-center justify-content-center">
            @include('partials.service-details', ['services' => $services, 'stay' => $stay])
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script src="{{ asset('js/booking.js') }}"></script>
@endsection