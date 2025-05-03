@extends('layout.layout')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <style>
        .min-date-highlight {
            opacity: 100% !important;
        }

        .min-date-highlight span {
            background-color: #66b0ff !important;

        }

        #ui-datepicker-div {
            background-color: gold !important;
            border-radius: 20px !important;
        }

        .ui-datepicker-header {
            border-radius: 20px !important;
        }

        .ui-state-default {
            border-radius: 100% !important;
            text-align: center !important;
        }

        .ui-datepicker .ui-datepicker-calendar .booked a {
            background-color: #ff6b6b !important;
            color: white !important;
            text-decoration: line-through;
            border-color: #ff0000 !important;
        }

        .ui-datepicker .ui-datepicker-calendar .booked a.ui-state-default:hover {
            background-color: #ff5252 !important;
            cursor: not-allowed;
        }

        .ui-datepicker .ui-datepicker-calendar .booked a.ui-state-active {
            background-color: #ff0000 !important;
        }

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

        .slide-image {
            height: 200px;
            background-size: cover;
            background-position: center;
        }

        .slide-image img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .about-section {
            background-color: #f7f7f7;
            padding: 20px;
            margin-top: 20px;
        }

        .service-booking {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .about-section .service-info {
            display: flex;

            align-items: center;
            justify-content: center;
        }

        .about-section .service-description {
            text-align: center;
            margin-bottom: 20px;
        }

        .about-section .service-description h2 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .about-section .service-description p {
            font-size: 18px;
            color: #666;
        }

        .about-section .service-link {
            text-align: center;
        }

        .about-section .explore-btn {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .about-section .explore-btn:hover {
            background-color: #444;
        }


        .booking-section {
            text-align: center;
            background-color: #ffff;
            background-image: linear-gradient(to bottom, #f7f7f7, #fff);
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .col-xl-6 {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .service-description img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }


        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        .form-control {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .explore-btn {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .explore-btn:hover {
            background-color: #444;
        }

        .booking-section {
            background-color: #fff;
            justify-content: center;

            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
    <style>
        /* Blue highlight style for minDate in #to datepicker */
        .min-date-highlight a {
            background-color: #cce5ff !important;
            border-color: #66b0ff !important;
            color: #004085 !important;
            cursor: not-allowed !important;
        }
    </style>

@endsection

@section('main')

<!-- All existing sections remain unchanged until the form section -->
    <!-- ... -->
    <section class="container-fluid p-0 mb-10 overflow-hidden" style="height: 75vh  ;">
        @php
            $arry = json_decode($services->service_images)
        @endphp
        <div class="background-img"
            style="background-image: url({{ asset($services->banner_photo) }}); background-size:cover; height: 100%;">
            <div class="row main-frame" style="height: 100%;">
                <div class="col-xl-6 position-relative h-100">
                    <div class="banner-text position-absolute"
                        style="bottom: 100px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);background-color: rgb(47 44 44 / 80%); ">
                        <h1 class="text-white">{{ $services->name }}</h1>
                    </div>
                </div>
                <div class="col-xl-6 d-flex flex-column sub-frame"
                    style="height: 100%; display: flex; align-items: center;">
                    <div class="col-xl-12 service-inquiry">
                        <div class="service-title text-white">
                            <h1>Inquiry</h1>
                        </div>
                        <div class="service-text text-white">
                            <p style="box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);background-color: rgb(47 44 44 / 80%); ">Villa
                                Marion is a stunning 6 bedroom property with exceptional design features which
                                comprises the main house and a separate private poolside annex. This stylish home
                                occupies a
                                secluded spot between the picturesque village of San José and the beach of Cala Jondal,
                                home
                                to the famous Blue Marlin Beach Club.</p>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="row img-carousel-row pos">
                            <div class="owl-carousel owl-theme image-slide">
                                @if(count($arry) > 1)
                                    @forEach($arry as $image)
                                        <div class="slide-image" style="background-image: url({{ asset($image) }});"></div>
                                    @endforeach
                                @else
                                    <div class="slide-image" style="background-image: url({{ asset($arry[0]) }});"></div>
                                    <div class="slide-image" style="background-image: url({{ asset($arry[0]) }});"></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
    </section>
    <section class="my-5 row about-section service-info">
        <div id="status-carousel" class="owl-carousel owl-theme">
            @foreach ($stays as $stay)
                        @php
                            $service_images = json_decode($stay->service_images);
                        @endphp

                            <div class="card mb-4">
                                <div id="carousel-{{ $stay->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class=" carousel-inner">
                                        @foreach ($service_images as $index => $image)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <img src="{{ asset($image) }}" class="d-block img-fluid" alt="Villa Image" style="width: 100%; height: 300px; object-fit: cover; border-radius: 10px;">
                                            </div>
                                        @endforeach
                                    </div>

                            </div>
                            <div class="card-body">
                                <h2 class="card-title"><strong> {{ $stay->Name }}</strong></h2>
                                <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{ $stay->location }}</p>
                                <ul class="list-unstyled">
                                    @if($stay->category_id == 1)
                                        
                                    <li><i class="fas fa-bed"></i> {{ $stay->beds }} Beds</li>
                                    <li><i class="fas fa-bath"></i> {{ $stay->baths }} Baths</li>
                                    <li><i class="fas fa-users"></i> Accommodates {{ $stay->guests }} Guests</li>
                                    @endif
                                    @if($stay->category_id == 3 || $stay->category_id == 4)
                                    <li><i class="fas fa-concierge-bell"></i> Amenities: {{ $stay->amenities }}</li>
                                    @endif
                                </ul>
                                @if($stay->category_id == 1)
                                    
                                <p class="card-text"><strong>From {{ $stay->type->price }} RS/{{ $stay->type->booking_type }}</strong></p>
                                @elseif($stay->category_id == 3 || $stay->category_id == 4 || $stay->category_id == 2)
                                <p class="card-text"><strong>From {{ $stay->get_type->price }} RS/{{ $stay->get_type->booking_type }}</strong></p>
                                @endif
                                <a href="       {{ route('conformbooking.index', [$services->category->id, $services->id, $services->types->id, $stay->id])}}
                " class="btn btn-primary w-100">book now</a>
                            </div>
                        </div>
            @endforeach
        </div>
    </section>
  

@endsection


@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
        integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function () {
            $("#status-carousel").owlCarousel({
                items: 3,
                margin: 10,
                loop: true,
                nav: true,
                navText: ["<div class='nav-button owl-prev'>&larr;</div>", "<div class='nav-button owl-next'>&rarr;</div>"],
                autoplay: true,
                autoplayTimeout: 3000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        });
    </script>
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

            });
        });
    </script>
    @if($services->category_id == 1)
        <script>
            let startDate, endDate;

            function fetchAvailability() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: "get",
                    url: "{{route('availability', [$services->id, $services->types->id])}}",
                    success: function (data) {

                        // Process booked dates into YYYY-MM-DD format
                        const bookedDates = data.bookedDates.flatMap(booking => {
                            const dates = [];
                            let current = new Date(booking.from);
                            const end = new Date(booking.to);

                            while (current <= end) {
                                dates.push(current.toISOString().split('T')[0]);
                                current.setDate(current.getDate() + 1);
                            }
                            return dates;
                        });


                        // Initialize datepickers with availability checking
                        $("#from").datepicker({
                            dateFormat: 'yy-mm-dd',
                            minDate: 0,
                            beforeShowDay: function (date) {
                                const dateString = $.datepicker.formatDate('yy-mm-dd', date);
                                const isBooked = bookedDates.includes(dateString);
                                const isPast = date < new Date();
                                if (isBooked) {
                                    return [true, 'booked', 'Booked'];
                                } else if (isPast) {
                                    return [false, '', ''];
                                } else {
                                    return [true, '', ''];
                                }
                            }
                        });

                        $("#to").datepicker({
                            dateFormat: 'yy-mm-dd',
                            minDate: 0,
                            beforeShowDay: function (date) {
                                const dateString = $.datepicker.formatDate('yy-mm-dd', date);
                                const isBooked = bookedDates.includes(dateString);
                                const isPast = date < new Date();
                                const minDate = $("#to").datepicker("option", "minDate");
                                const isMinDate = minDate && date.getTime() === minDate.getTime();
                                if (isMinDate) {
                                    // Disable minDate and add blue highlight class
                                    return [false, 'min-date-highlight', 'Minimum selectable date'];
                                }
                                if (isBooked) {
                                    return [true, 'booked', 'Booked'];
                                } else if (isPast) {
                                    return [false, '', ''];
                                } else {
                                    return [true, '', ''];
                                }
                            }
                        });

                        $("#from").on('change', function () {
                            startDate = $(this).datepicker('getDate');
                            $("#to").datepicker('option', 'minDate', startDate);


                            updateTimeSlots(data.available_slots);
                        });

                        $("#to").on('change', function () {
                            endDate = $(this).datepicker('getDate');
                            $("#from").datepicker('option', 'maxDate', endDate);
                            updateTimeSlots(data.available_slots);
                        });

                        $('#checkin-time, #checkout-time').data('originalOptions',
                            $('#checkin-time').html()
                        );
                        function initBasicDatepickers() {
                            $("#from, #to").datepicker({
                                dateFormat: 'yy-mm-dd',
                                minDate: 0
                            });

                            $("#from").on('change', function () {
                                startDate = $(this).datepicker('getDate');

                                $("#to").datepicker('option', 'minDate', startDate);
                                $('.min-date-highlight').css('background-color', 'blue').removeClass('ui-state-disabled');
                            });

                            $("#to").on('change', function () {
                                endDate = $(this).datepicker('getDate');
                                $("#from").datepicker('option', 'maxDate', endDate);
                            });
                        }

                        function addIntervalToTime(startTime, interval) {
                            // startTime expected format: "HH:mm" or "HH:mm:ss"
                            const timeParts = startTime.split(':');
                            let hours = parseInt(timeParts[0], 10);
                            let minutes = parseInt(timeParts[1], 10);
                            // Add interval hours
                            hours += interval;
                            // Handle overflow of hours > 23
                            if (hours >= 24) {
                                hours = hours % 24;
                            }
                            // Format hours and minutes to HH:mm
                            const formattedHours = hours.toString().padStart(2, '0');
                            const formattedMinutes = minutes.toString().padStart(2, '0');
                            return `${formattedHours}:${formattedMinutes}`;
                        }

                        function updateTimeSlots(availableSlots) {
                            const checkinTime = $('#checkin-time');
                            const checkoutTime = $('#checkout-time');

                            // Clear existing options before appending new ones
                            checkinTime.empty();
                            checkoutTime.empty();

                            const interval = data.interval || 1; // interval in hours, default 1
                            const bookingStart = data.availableSlots[0].start; // e.g. "08:00"
                            const bookingEnd = data.availableSlots[0].end; // e.g. "20:00"


                            function timeToMinutes(t) {
                                if (typeof t !== 'string' || !t.includes(':')) {
                                    return 0;
                                }
                                const [h, m] = t.split(':').map(Number);
                                return h + m / 60;
                            }

                            // Generate time slots from bookingStart to bookingEnd with interval
                            let currentStart = bookingStart;
                            while (timeToMinutes(currentStart) < timeToMinutes(bookingEnd)) {
                                let currentEnd = addIntervalToTime(currentStart, interval);
                                // If currentEnd exceeds bookingEnd, set it to bookingEnd
                                if (timeToMinutes(currentEnd) > timeToMinutes(bookingEnd)) {
                                    currentEnd = bookingEnd;
                                }

                                const timeRange = `${currentStart} - ${currentEnd}`;

                                // Determine availability for this slot
                                // Check if any availableSlots overlap with this time range
                                let isAvailable = false;
                                if (availableSlots && availableSlots.length > 0) {
                                    isAvailable = availableSlots.some(slot => {
                                        // slot.start and slot.end assumed in "HH:mm" format
                                        const slotStart = slot.start;
                                        const slotEnd = slot.end || addIntervalToTime(slot.start, interval);
                                        return (timeToMinutes(slotStart) <= timeToMinutes(currentStart)) &&
                                            (timeToMinutes(slotEnd) >= timeToMinutes(currentEnd)) &&
                                            slot.available;
                                    });
                                } else {
                                    // If no availableSlots data, assume available
                                    isAvailable = true;
                                }

                                // Add check-in option
                                const checkinOption = $(`<option value="${currentStart}">${timeRange}</option>`);
                                if (!isAvailable) {
                                    checkinOption.prop('disabled', true)
                                        .css({ 'color': '#ff6b6b', 'text-decoration': 'line-through' });
                                }
                                checkinTime.append(checkinOption);

                                // Add check-out option
                                const checkoutOption = $(`<option value="${currentEnd}">${timeRange}</option>`);
                                if (!isAvailable) {
                                    checkoutOption.prop('disabled', true)
                                        .css({ 'color': '#ff6b6b', 'text-decoration': 'line-through' });
                                }
                                checkoutTime.append(checkoutOption);

                                currentStart = currentEnd;
                            }

                            // Disable check-out times earlier than selected check-in time
                            // checkinTime.on('change', function () {
                            //     const selectedCheckin = $(this).val();
                            //     checkoutTime.find('option').each(function () {
                            //         if ($(this).val() <= selectedCheckin) {
                            //             $(this).prop('disabled', true).css({ 'color': '#ff6b6b', 'text-decoration': 'line-through' });
                            //         } else {
                            //             $(this).prop('disabled', false).css({ 'color': '', 'text-decoration': '' });
                            //         }
                            //     });
                            // });
                        }
                    }
                });
            }




            $(document).ready(function () {
                fetchAvailability();
            });

            // Initialize on page load
        </script>
    @elseif($services->category_id == 2)
        <script>
            let startDate, endDate;

            function fetchAvailability() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: "get",
                    url: "{{route('availability', [$services->id, $services->types->id])}}",
                    success: function (data) {

                        // Process booked dates into YYYY-MM-DD format
                        const bookedDates = data.bookedDates.flatMap(booking => {
                            const dates = [];
                            let current = new Date(booking.from);
                            const end = new Date(booking.to);

                            while (current <= end) {
                                dates.push(current.toISOString().split('T')[0]);
                                current.setDate(current.getDate() + 1);
                            }
                            return dates;
                        });


                        // Initialize datepickers with availability checking
                        $("#from").datepicker({
                            dateFormat: 'yy-mm-dd',
                            minDate: 0,
                            beforeShowDay: function (date) {
                                const dateString = $.datepicker.formatDate('yy-mm-dd', date);
                                const isBooked = bookedDates.includes(dateString);
                                const isPast = date < new Date();
                                if (isBooked) {
                                    return [true, 'booked', 'Booked'];
                                } else if (isPast) {
                                    return [false, '', ''];
                                } else {
                                    return [true, '', ''];
                                }
                            }
                        });

                        $("#to").datepicker({
                            dateFormat: 'yy-mm-dd',
                            minDate: 0,
                            beforeShowDay: function (date) {
                                const dateString = $.datepicker.formatDate('yy-mm-dd', date);

                                const isBooked = bookedDates.includes(dateString);
                                const isPast = date < new Date();
                                const minDate = $("#to").datepicker("option", "minDate");
                                const isMinDate = minDate && date.getTime() === minDate.getTime();

                                if (isBooked) {
                                    return [true, 'booked', 'Booked'];
                                } else if (isPast) {
                                    return [false, '', ''];
                                } else {
                                    return [true, '', ''];
                                }
                            }
                        });

                        $("#from").on('change', function () {
                            startDate = $(this).datepicker('getDate');
                            $("#to").datepicker('option', 'minDate', startDate);


                            updateTimeSlots(data.availableSlots);
                        });

                        $("#to").on('change', function () {
                            endDate = $(this).datepicker('getDate');
                            $("#from").datepicker('option', 'maxDate', endDate);
                            updateTimeSlots(data.availableSlots);
                        });

                        $('#checkin-time, #checkout-time').data('originalOptions',
                            $('#checkin-time').html()
                        );
                        function initBasicDatepickers() {
                            $("#from, #to").datepicker({
                                dateFormat: 'yy-mm-dd',
                                minDate: 0
                            });

                            $("#from").on('change', function () {
                                startDate = $(this).datepicker('getDate');
                                $("#to").datepicker('option', 'minDate', startDate);
                                $('.min-date-highlight').css('background-color', 'blue').removeClass('ui-state-disabled');
                            });

                            $("#to").on('change', function () {
                                endDate = $(this).datepicker('getDate');
                                $("#from").datepicker('option', 'maxDate', endDate);
                            });

                        }

                        function formcars() {
                            startDate = $('#from').datepicker('getDate');
                            endDate = $('#to').datepicker('getDate');
                            if (startDate !== endDate) {
                                $('#cars').removeClass('d-none')
                            }
                            else (console.log('done'))
                        }

                        $("#to").on('focusout', function () {
                            formcars();

                        })

                        function addIntervalToTime(startTime, interval) {
                            // startTime expected format: "HH:mm" or "HH:mm:ss"
                            const timeParts = startTime.split(':');
                            let hours = parseInt(timeParts[0], 10);
                            let minutes = parseInt(timeParts[1], 10);
                            // Add interval hours
                            hours += interval;
                            // Handle overflow of hours > 23
                            if (hours >= 24) {
                                hours = hours % 24;
                            }
                            // Format hours and minutes to HH:mm
                            const formattedHours = hours.toString().padStart(2, '0');
                            const formattedMinutes = minutes.toString().padStart(2, '0');
                            return `${formattedHours}:${formattedMinutes}`;
                        }

                        function updateTimeSlots(availableSlots) {
                            const checkinTime = $('#checkin-time');
                            const checkoutTime = $('#checkout-time');

                            // Clear existing options before appending new ones
                            checkinTime.empty();
                            checkoutTime.empty();

                            if (availableSlots && availableSlots.length > 0) {
                                availableSlots.forEach(slot => {
                                    const timeRange = `${slot.start} - ${slot.end}`;

                                    // Add check-in option
                                    const checkinOption = $(`<option value="${slot.start}">${timeRange}</option>`);
                                    if (!slot.available) {
                                        checkinOption.prop('disabled', true)
                                            .css({ 'color': '#ff6b6b', 'text-decoration': 'line-through' });
                                    }
                                    checkinTime.append(checkinOption);

                                    // Add check-out option
                                    const checkoutOption = $(`<option value="${slot.end}">${timeRange}</option>`);
                                    if (!slot.available) {
                                        checkoutOption.prop('disabled', true)
                                            .css({ 'color': '#ff6b6b', 'text-decoration': 'line-through' });
                                    }
                                    checkoutTime.append(checkoutOption);
                                });
                            }
                        }
                    }
                });
            }




            $(document).ready(function () {
                fetchAvailability();
            });

            // Initialize on page load
        </script>
    @endif
    <!-- <script>
                                                                                                                $('#addtocart').on('click', function (e) {
                                                                                                                    e.preventDefault();
                                                                                                                    $.ajax({
                                                                                                                        headers: {
                                                                                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                                                                        },
                                                                                                                        type: "POST",
                                                                                                                        url: "//{{ route('addtocart', $services->id) }}",
                                                                                                                        success: function(response) {
                                                                                                                            if(response.success) {
                                                                                                                                // Update cart count in UI
                                                                                                                                $('.cart-count').text(response.cart_count);
                                                                                                                                // Show success toast
                                                                                                                                alert(response.message);
                                                                                                                            } else {
                                                                                                                                // Show warning if item already in cart
                                                                                                                                alert(response.message);
                                                                                                                            }
                                                                                                                        },
                                                                                                                        error: function(xhr) {
                                                                                                                            alert("Error adding to cart");
                                                                                                                        }
                                                                                                                    });
                                                                                                                });
                                                                                                            </script> -->
    @if($services->category_id == 1 || $services->category_id == 3 || $services->category_id == 4)
        <script>
            function increment(type) {
                let inputField = document.getElementById(type);
                inputField.value = parseInt(inputField.value) + 1;
                updateGuestPlaceholder();
            }

            function decrement(type) {
                let inputField = document.getElementById(type);
                if (parseInt(inputField.value) > 0) {
                    inputField.value = parseInt(inputField.value) - 1;
                    updateGuestPlaceholder();
                }
            }

            function updateGuestPlaceholder() {
                const adults = document.getElementById('adults').value;
                const children = document.getElementById('children').value;
                const pets = document.getElementById('pets').value;
                let parts = [];
                if (adults > 0) parts.push(`${adults} Adult${adults > 1 ? 's' : ''}`);
                if (children > 0) parts.push(`${children} Child${children > 1 ? 'ren' : ''}`);
                if (pets > 0) parts.push(`${pets} Pet${pets > 1 ? 's' : ''}`);
                const placeholderText = parts.length > 0 ? parts.join(', ') : 'Guests: tell about the guests';
                document.getElementById('guest').placeholder = placeholderText;
            }

            $(document).ready(function () {
                updateGuestPlaceholder();
                $('#guest').on('click', function () {
                    $('.guest-selector').toggle();
                });
            });
            $('.villa-img-container').each(function () {
                $(this).addClass('owl-carousel');
                $(this).owlCarousel({
                    items: 1,
                    loop: true,
                    nav: true,
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>']
                });
            });
        </script>
    @endif

@endsection