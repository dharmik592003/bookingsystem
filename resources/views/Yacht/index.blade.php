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
                <p class="hero-subtitle">Discover the finest yachts and yachting experiences in Ibiza. Experience
                    unparalleled luxury and adventure on the water.</p>
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
                    <select name="Depature" id="Departure" class="form-select" required>
                        <option value="">Departure </option>
                        @foreach ($ports as $port)
                            <option value="{{ $port->id }}">{{$port->Name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="city_id" class="form-label">Arrival</label>
                    <select name="Arrival" id="Arrival" class="form-select" required>
                        <option value="">Arrival</option>
                        @foreach ($ports as $port)
                            <option value="{{ $port->id }}">{{$port->Name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="check_in" class="form-label">Check-In Date</label>
                    <input type="date" name="check_in" id="check_in" class="form-control" required
                        min="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-3">
                    <label for="check_out" class="form-label">Check-Out Date</label>
                    <input type="date" name="check_out" id="check_out" class="form-control" required
                        min="{{ date('Y-m-d') }}">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Check Availability</button>
                        <button type="button" id="clearFilter" class="btn btn-secondary">Clear Filter</button>
                    </div>
            </form>
        </div>
        </div>
    </section>
    <!-- Yachts Section -->
    <section id="yachts" class="section-padding">
        <div class="container">
            <h2 class="section-title serif-font">Our Luxury Charters services</h2>
            <div class="row" id="unfiltered">
                @foreach ($services as $service)
                            @php
                                $service_images = json_decode($service->service_images);
                            @endphp

                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="charter-card">
                                    <div id="carousel-{{ $service->id }}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner" style="height: 300px; overflow: hidden;">
                                            @foreach ($service_images as $index => $image)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" style="height: 100%;">
                                                    <img src="{{ $image }}" class="charter-img img-fluid" alt="Charter Image"
                                                        style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carousel-{{ $service->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carousel-{{ $service->id }}" data-bs-slide="next">
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

            gsap.from('.btn-gold', {
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

            // Use ScrollTrigger.batch for villa-card animation for better performance and consistency
            ScrollTrigger.batch('.villa-card', {
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

            // Luxury section animation
            gsap.from('.luxury-box', {
                scrollTrigger: {
                    trigger: '.luxury-box',
                    start: 'top 80%'
                },
                duration: 1,
                y: 50,
                opacity: 0,
                stagger: 0.2,
                ease: 'power3.out'
            });

            // Testimonial section animation
            gsap.from('.testimonial-card', {
                scrollTrigger: {
                    trigger: '.testimonial-card',
                    start: 'top 80%'
                },
                duration: 1,
                y: 50,
                opacity: 0,
                stagger: 0.2,
                ease: 'power3.out'
            });

            // CTA section animation
            gsap.from('.cta-title', {
                scrollTrigger: {
                    trigger: '.cta-title',
                    start: 'top 80%'
                },
                duration: 1,
                y: 50,
                opacity: 0,
                ease: 'power3.out'
            });

            gsap.from('.cta-text', {
                scrollTrigger: {
                    trigger: '.cta-text',
                    start: 'top 80%'
                },
                duration: 1,
                y: 50,
                opacity: 0,
                delay: 0.3,
                ease: 'power3.out'
            });

            gsap.from('.btn-lg', {
                scrollTrigger: {
                    trigger: '.btn-lg',
                    start: 'top 80%'
                },
                duration: 1,
                y: 50,
                opacity: 0,
                delay: 0.6,
                ease: 'power3.out'
            });
        })
        // Initialize Owl Carousel for villa images
        $('.yacht-img-container').each(function () {
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


        // Load cities based on selected state


        $('#availabilityForm').submit(function (e) {
            e.preventDefault();
            var formData = $(this).serializeArray();
            var state_id = formData.find(x => x.name === 'Depature').value;
            var city_id = formData.find(x => x.name === 'Arrival').value;
            var check_in = formData.find(x => x.name === 'check_in').value;
            var check_out = formData.find(x => x.name === 'check_out').value;

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: '{{ route('yacht.filter')}}',
                data: {
                    'state_id': state_id,
                    'city_id': city_id,
                    'check_in': check_in,
                    'check_out': check_out
                },
                type: "GET",
                success: function (response) {
                    if (response.status == 'success') {
                        // Hide existing stays
                        $('#unfiltered').hide();

                        // Append filtered stays
                        response.data.forEach(function (stay) {
                            var stayHtml = `
                                <div class="col-lg-4 col-md-6 mb-4 filtered">
                                    <div class="villa-card">
                                        <div id="carousel-${stay.id}" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner" style="height: 300px; overflow: hidden;">
                                                ${(Array.isArray(stay.service_images) ? stay.service_images : JSON.parse(stay.service_images || '[]')).map((image, index) => `
                                                    <div class="carousel-item ${index === 0 ? 'active' : ''}" style="height: 100%;">
                                                        <img src="${image}" class="d-block w-100 car-img" alt="Car Image" style="width: 100%; height: 100%; object-fit: cover;">
                                                    </div>
                                                `).join('')}
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-${stay.id}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carousel-${stay.id}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </div>
                                        <div class="villa-card-body">
                                            <h3 class="villa-title">${stay.Name}</h3>
                                            <p class="villa-location">Cabins: ${stay.cabins}</p>
                                            <ul class="villa-features">
                                                <li><i class="fas fa-ruler-horizontal"></i> Length: ${stay.length} ft</li>
                                                <li><i class="fas fa-user-friends"></i> Guests: ${stay.guests}</li>
                                                <li><i class="fas fa-list"></i> Amenities: ${stay.amenities}</li>
                                            </ul>
                                            <a href="/${stay.category_id}/${stay.service_id}/${stay.type_id}/${stay.id}/conformbooking" class="btn btn-outline-dark w-100">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                            `;
                            $('#filtered').append(stayHtml);
                        });

                        // Reinitialize Owl Carousel for new stays
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
                    } else {
                        alert('No stays available for the selected criteria.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred while fetching stays. Please try again.');
                }
            });
        });
        // Clear Filter Button Functionality
        $('#clearFilter').click(function () {
            // Remove filtered stays
            $('.filtered').remove();

            // Show the original stays
            $('#unfiltered').show();
        });


    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkInInput = document.getElementById('check_in');
            const checkOutInput = document.getElementById('check_out');

            checkInInput.addEventListener('change', function () {
                const checkInDate = new Date(this.value);
                checkInDate.setDate(checkInDate.getDate() + 1); // Ensure check-out is at least 1 day after check-in
                checkOutInput.min = checkInDate.toISOString().split('T')[0];
            });

            checkOutInput.addEventListener('change', function () {
                const checkOutDate = new Date(this.value);
                const checkInDate = new Date(checkInInput.value);

                if (checkOutDate <= checkInDate) {
                    alert('Check-Out date must be after Check-In date.');
                    this.value = '';
                }
            });
        });
    </script>
    <!-- jQuery and Owl Carousel JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
@endsection