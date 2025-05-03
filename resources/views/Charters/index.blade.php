@extends('layout.layout')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
    <style>
        :root {
            --primary-color: #000000;
            --secondary-color: #f8f8f8;
            --accent-color: #ff5a5f;
            --gold-color: #c8a97e;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--primary-color);
            background-color: #fff;
            overflow-x: hidden;
        }

        /* Custom styles for Owl Carousel nav buttons */
        .yacht-img-container.owl-carousel {
            min-height: 200px; /* Ensure visible height */
        }

        .yacht-img-container.owl-carousel .owl-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s ease;
            padding: 0 10px;
            box-sizing: border-box;
            z-index: 10;
        }

        .yacht-img-container.owl-carousel:hover .owl-nav {
            opacity: 1;
            pointer-events: auto;
        }

        .yacht-img-container.owl-carousel .owl-nav button.owl-prev,
        .yacht-img-container.owl-carousel .owl-nav button.owl-next {
            background: rgba(200, 169, 126, 0.8);
            border: none;
            padding: 8px 12px;
            border-radius: 50%;
            color: #000;
            font-size: 1.5rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .yacht-img-container.owl-carousel .owl-nav button.owl-prev:hover,
        .yacht-img-container.owl-carousel .owl-nav button.owl-next:hover {
            background: rgba(200, 169, 126, 1);
        }

        h1,
        h2,
        h3,
        h4,
        .serif-font {
            font-family: 'Playfair Display', serif;
        }

        /* Hero Section */
        .hero-section {
            background-image: url('{{ asset($category->photo) }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
        }




        .owl-stage-outer {
            height: 200px !important;
        }

        .owl-stage {
            height: 200px !important;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            color: white;
            padding: 0 15px;
            max-width: 800px;
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.1;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            font-weight: 300;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .btn-gold {
            background-color: var(--gold-color);
            border: none;
            color: #000;
            padding: 12px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-gold:hover {
            background-color: #b89a6d;
            color: #000;
            transform: translateY(-2px);
        }
    </style>
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
@endsection


@section('main')
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Luxury Yachts</h1>
                <p class="hero-subtitle">Discover the finest yachts and yachting experiences in Ibiza. Experience unparalleled luxury and adventure on the water.</p>
                <a href="#yachts" class="btn btn-primary">Explore Our Yachts</a>
            </div>
        </div>
    </section>
    <!-- Availability Form Section -->
    <section class="section-padding m-5">
        <div class="container">
            <form id="availabilityForm" method="POST" action="#" class="row g-3">
                @csrf
                <div class="col-md-3">
                    <label for="state_id" class="form-label">Departure</label>
                    <select name="Departure" id="Departure" class="form-select" required>
                        <option value="">Departure </option>
                        @foreach ($ports as $port )
                        <option value="{{ $port->id }}">{{$port->Name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="city_id" class="form-label">Arrival</label>
                    <select name="Arrival" id="Arrival" class="form-select" required>
                        <option value="">Arrival</option>
                        @foreach ($ports as $port )
                        <option value="{{ $port->id }}">{{$port->Name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="check_in" class="form-label">Check-In Date</label>
                    <input type="date" name="check_in" id="check_in" class="form-control" required
                        min="{{ date('Y-m-d') }}">
                </div>
                
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Check Availability</button>
                        <button type="button" id="clearFilter" class="btn btn-secondary">Clear Filter</button>
                    </div>
            </form>
        </div>
        
    </section>


    <!-- charter Section -->
    <section id="charters" class="section-padding">
        <div class="container">
            <h2 class="section-title serif-font">Our Luxury Charters</h2>
            <div class="row" id="unfiltered">
                @foreach ($services as $service)
                    @php
                        $service_images = json_decode($service->service_images);
                    @endphp

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="charter-card">
                            <div id="charterCarousel{{ $service->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner" style="height: 200px; overflow: hidden;">
                                    @foreach ($service_images as $index => $image)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ $image }}" class="d-block w-100 charter-img img-fluid" alt="Charter Image">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#charterCarousel{{ $service->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#charterCarousel{{ $service->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <div class="charter-card-body">
                                <h3 class="charter-title">{{ $service->name }}</h3>
                                <p class="charter-location">{{ $service->location }}</p>
                                <ul class="charter-features">
                                    <li><i class="fas fa-building"></i> {{ $service->comapny_details }}</li>
                                    <li><i class="fas fa-map-marker-alt"></i> {{ $service->address }}</li>
                                    <li><i class="fas fa-phone"></i> {{ $service->number }}</li>
                                    <li><i class="fas fa-envelope"></i> {{ $service->email }}</li>
                                </ul>
                                <a href="{{ Route('detailsservices', [$service->category->name, $service->name]) }}"
                                    class="btn btn-outline-dark w-100">Book Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row" id="filtered"></div>
        </div>
    </section>



@endsection
@section('script')

    <!-- jQuery and Owl Carousel JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- GSAP Animations -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Register GSAP plugins
            gsap.registerPlugin(ScrollTrigger);

            // Hero section animation
            gsap.from('.hero-title', {
                duration: 1,
                y: 50,
                opacity: 0,
                ease: 'power3.out'
            });

            gsap.from('.hero-subtitle', {
                duration: 1,
                y: 50,
                opacity: 0,
                delay: 0.3,
                ease: 'power3.out'
            });

            // Changed from .btn-gold to .btn-primary because .btn-gold does not exist in HTML
            gsap.from('.btn-primary', {
                duration: 1,
                y: 50,
                opacity: 0,
                delay: 0.6,
                ease: 'power3.out'
            });
            
            // Villas section animation
            gsap.from('.section-title', {
                scrollTrigger: {
                    trigger: '.section-title',
                    start: 'top 80%'
                },
                duration: 1,
                y: 50,
                opacity: 0,
                ease: 'power3.out'
            });

            // Use ScrollTrigger.batch for charter-card animation for better performance and consistency
            ScrollTrigger.batch('.charter-card', {
                start: 'top 80%',
                onEnter: batch => {
                    gsap.fromTo(batch,
                        { y: 50, opacity: 0 },
                        { y: 0, opacity: 1, duration: 1, stagger: 0.2, ease: 'power3.out' }
                    );
                },
                onEnterBack: batch => {
                    gsap.fromTo(batch,
                        { y: 50, opacity: 0 },
                        { y: 0, opacity: 1, duration: 1, stagger: 0.2, ease: 'power3.out' }
                    );
                },
                onLeave: batch => {
                    gsap.set(batch, { opacity: 0, y: 50 });
                }
            });

            // Removed luxury-box animation because .luxury-box does not exist in HTML

            // Removed testimonial-card animation because .testimonial-card does not exist in HTML

            // Removed CTA section animations because .cta-title, .cta-text, .btn-lg do not exist in HTML

            // Initialize states on page load
            function loadStates() {
                $.ajax({
                    url: "{{ route('sendstates') }}",
                    type: "GET",
                    data: { id: 102 },
                    success: function (data) {

                        $('#state_id').empty().append('<option value="">-- Select State --</option>');
                        $.each(data.id, function (key, value) {
                            $('#state_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            }

            // Load cities based on selected state
            $('#state_id').on('change', function () {
                var stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        url: "{{ route('sendcity') }}",
                        type: "GET",
                        data: { id: stateId },
                        success: function (data) {
                            $('#city_id').empty().append('<option value="">-- Select City --</option>');
                            $.each(data.id, function (key, value) {
                                $('#city_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#city_id').empty().append('<option value="">-- Select City --</option>');
                }
            });

            // Initialize states on page load
            loadStates();
        });

        $('#availabilityForm').submit(function (e) {
            e.preventDefault();
            var formData = $(this).serializeArray();
            var state_id = formData.find(x => x.name === 'Departure').value;
            var city_id = formData.find(x => x.name === 'Arrival').value;
            var check_in = formData.find(x => x.name === 'check_in').value;
            var check_out = formData.find(x => x.name === 'check_out').value;

            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: '{{ route('charter.filter')}}',
            data: {
                'state_id': state_id,
                'city_id': city_id,
                'check_in': check_in,
                'check_out': check_in
            },
            type: "GET",
            success: function (response) {
                if (response.status === "success") {
                    console.log(response);
                    // Hide existing stays
                    $('#unfiltered').hide();

                    // Append filtered stays
                    response.data.forEach(function (charter) {
                       
                        var serviceImages = JSON.parse(charter.service_images);
                        var stayHtml = `
                            <div class="col-lg-4 col-md-6 mb-4 filtered">
                                <div class="charter-card">
                                    <div class="charter-img-container owl-carousel">
                                        ${serviceImages.map(image => `<img src="${image}" class="charter-img img-fluid" alt="Charter Image">`).join('')}
                                    </div>
                                    <div class="charter-card-body">
                                        <h3 class="charter-title">${charter.Name}</h3>
                                        
                                        <ul class="charter-features">
                                            <li><i class="fas fa-building"></i> Capacity: ${charter.capacity}</li>
                                            <li><i class="fas fa-clock"></i> Duration: ${charter.duration_hours} hours</li>
                                            <li><i class="fas fa-list"></i> Amenities: ${charter.amenities}</li>
                                        </ul>
                                        <a href="/details/${charter.category_id}/${charter.id}" class="btn btn-outline-dark w-100">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('#filtered').append(stayHtml);
                    });

                    // Reinitialize Owl Carousel for new stays
                    $('.charter-img-container').each(function () {
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
                } else {
                    alert('No charter available for the selected criteria.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while fetching charters. Please try again.');
            }});});
            // Clear Filter Button Functionality
            $('#clearFilter').click(function () {
                // Remove filtered stays
                $('.filtered').remove();

                // Show the original stays
                $('#unfiltered').show();
            });
    </script>
@endsection
