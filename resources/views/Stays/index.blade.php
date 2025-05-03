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
        .villa-img-container.owl-carousel .owl-nav {
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

        .villa-img-container.owl-carousel:hover .owl-nav {
            opacity: 1;
            pointer-events: auto;
        }

        .villa-img-container.owl-carousel .owl-nav button.owl-prev,
        .villa-img-container.owl-carousel .owl-nav button.owl-next {
            background: rgba(200, 169, 126, 0.8);
            border: none;
            padding: 8px 12px;
            border-radius: 50%;
            color: #000;
            font-size: 1.5rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .villa-img-container.owl-carousel .owl-nav button.owl-prev:hover,
        .villa-img-container.owl-carousel .owl-nav button.owl-next:hover {
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
                <h1 class="hero-title">Luxury Stays</h1>
                <p class="hero-subtitle">Discover the finest villas and accommodations in Ibiza. Experience unparalleled
                    comfort and elegance during your stay.</p>
                <a href="#villas" class="btn btn-primary">Explore Our Villas</a>
            </div>
        </div>
    </section>
    <!-- Availability Form Section -->
    <section class="section-padding m-5">
        <div class="container">
            <form id="availabilityForm" method="POST" action="#" class="row g-3">
                @csrf
                <div class="col-md-3">
                    <label for="state_id" class="form-label">State</label>
                    <select name="state_id" id="state_id" class="form-select" required>
                        <option value="">-- Select State --</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="city_id" class="form-label">City</label>
                    <select name="city_id" id="city_id" class="form-select" required>
                        <option value="">-- Select City --</option>
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
                </div>

        
                <div class="col-12 d-flex flex-row">
                    <button type="submit" class="btn btn-primary">Check Availability</button>
                    <button type="button" id="clearFilter" class="btn btn-secondary">Clear Filter</button>
                </div>
            </form>

        </div>
    </section>

    <!-- Villas Section -->
    <section id="villas" class="section-padding">
        <div class="container">
            <h2 class="secti</div>on-title serif-font">Our Luxury Villas</h2>
            <div class="row" id="unfiltered">


                @foreach ($services as $service)
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
                                        <p class="villa-location">{{ $service->location }}</p>
                                        <ul class="villa-features">
                                            <li><i class="fas fa-building"></i> {{$service->comapny_details}}</li>
                                            <li><i class="fas fa-map-marker-alt"></i> {{$service->address}}</li>
                                            <li><i class="fas fa-phone"></i> {{$service->number}}</li>
                                            <li><i class="fas fa-envelope"></i> {{$service->email}}</li>
                                        </ul>
                                        <a href="{{route('detailsservices', [$service->category->name, $service->name])}}"
                                            class="btn btn-outline-dark w-100">Book Now</a>
                                    </div>
                                </div>
                            </div>
                @endforeach
                <!-- Villa 2 -->

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




            // Initialize Owl Carousel for villa images
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

            // Load states on page load
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

            // Serialize form data
            var formData = $(this).serializeArray();
            var state_id = formData.find(x => x.name === 'state_id').value;
            var city_id = formData.find(x => x.name === 'city_id').value;
            var picking_up_date = formData.find(x => x.name === 'check_in').value;
            var dropping_off_date = formData.find(x => x.name === 'check_out').value;

            // AJAX request
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: '{{ route('stays.filter') }}',
                data: {
                    'state_id': state_id,
                    'city_id': city_id,
                    'category_id': {{ $category->id }},
                    'check_in': picking_up_date,
                    'check_out': dropping_off_date
                },
                type: "GET",
                cache: false,
                success: function (response) {
                    if (response.success) {
                        // Hide existing stays instead of removing them  <div class="villa-img-container owl-carousel">
                        //     ${JSON.parse(stay.service_images).map(image => `
                        //         <img src="${image}" class="villa-img img-fluid" alt="Villa Image">
                        //     `).join('')}
                        // </div>
                        $('#unfiltered').hide();

                        // Append filtered stays
                        response.data.forEach(function (stay) {
                            var stayHtml = `
                                    <div class="col-lg-4 col-md-6 mb-4 filtered">
                                        <div class="villa-card">
                                              <div class="villa-img-container owl-carousel">
                                            ${(Array.isArray(stay.service_images) ? stay.service_images : JSON.parse(stay.service_images || '[]')).map(image => `<img src="${image}" class="villa-img img-fluid" alt="villa Image">`).join('')}
                                            </div>
                                            <div class="villa-card-body">
                                                <h3 class="villa-title">${stay.Name}</h3>
                                                <p class="villa-location">${stay.service.address}</p>
                                                <ul class="villa-features">
                                                    <li><i class="fas fa-building"></i> ${stay.service.company_details}</li>
                                                    <li><i class="fas fa-map-marker-alt"></i> ${stay.service.address}</li>
                                                    <li><i class="fas fa-phone"></i> ${stay.service.number}</li>
                                                    <li><i class="fas fa-envelope"></i> ${stay.service.email}</li>
                                                </ul>
                                                <a href="/services/${stay.service.category.name}/${stay.service.name}" class="btn btn-outline-dark w-100">Book Now</a>
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

            // Clear Filter Button Functionality
            $('#clearFilter').click(function () {
                // Remove filtered stays
                $('.filtered').remove();

                // Show the original stays
                $('#unfiltered').show();
            });
        })

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