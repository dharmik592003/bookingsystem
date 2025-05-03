@extends('layout.layout')
@section('style')
    <!-- Font Awesome CSS (best solution) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #000000;
            --secondary-color: #f8f8f8;
            --accent-color: #ff5a5f;
        }

.owl-stage{width: 500px !important;}

        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--primary-color);
            background-color: #fff;
            overflow-x: hidden;
        }

        .hero-section {
            background-image: url('{{ asset($category->photo) }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
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
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 2rem;
            max-width: 600px;
        }

        .btn-primary {
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #e04a4f;
            transform: translateY(-2px);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            text-align: center;
            text-transform: uppercase;
        }

        .car-card {
            border: none;
            border-radius: 0;
            margin-bottom: 30px;
            transition: all 0.3s ease;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .car-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .car-img {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }

        .card-body {
            padding: 25px;
        }

        .car-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .car-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 1rem;
        }

        .car-features {
            list-style: none;
            padding: 0;
            margin-bottom: 1.5rem;
        }

        .car-features li {
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .car-features i {
            margin-right: 8px;
            color: var(--accent-color);
        }

        .info-section {
            padding: 100px 0;
            background-color: var(--secondary-color);
        }

        .info-box {
            padding: 40px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .info-icon {
            font-size: 3rem;
            color: var(--accent-color);
            margin-bottom: 1.5rem;
        }

        .info-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .info-text {
            color: #666;
            line-height: 1.6;
        }

        .testimonial-section {
            padding: 100px 0;
            background-image: url('https://www.louxibiza.com/wp-content/uploads/2023/04/testimonial-bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
        }

        .testimonial-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .testimonial-content {
            position: relative;
            z-index: 1;
            color: white;
        }

        .testimonial-card {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 5px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .testimonial-text {
            font-style: italic;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .testimonial-author {
            font-weight: 600;
        }

        .cta-section {
            padding: 100px 0;
            background-color: var(--primary-color);
            color: white;
            text-align: center;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .cta-text {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .car-img {
                height: 200px;
            }

            .info-box {
                padding: 30px;
                margin-bottom: 30px;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .car-title {
                font-size: 1.3rem;
            }

            .car-price {
                font-size: 1.1rem;
            }
        }
    </style>
@endsection
@section('main')
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Car Rentals</h1>
                <p class="hero-subtitle">Explore Ibiza in style with our premium fleet of vehicles. From luxury cars to
                    practical SUVs, we have the perfect ride for your island adventure.</p>
                <a href="#cars" class="btn btn-primary">Explore Our Cars</a>
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
    <!-- Cars Section -->
    <section id="cars" class="py-5">
        <div class="container py-5">
            <h2 class="section-title">Our Fleet</h2>
            <div class="row" id="unfiltered">
                <!-- Car 1 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    @foreach ($services as $service)
                        <div class="car-card">
                            <img src="{{$service->banner_photo}}" class="car-img" alt="Mercedes G Class">
                            <div class="card-body">
                                <h3 class="car-title">{{$service->name}}</h3>
                                <ul class="car-features">
                                    <li><i class="fas fa-building"></i> {{$service->comapny_details}}</li>
                                    <li><i class="fas fa-map-marker-alt"></i> {{$service->address}}</li>
                                    <li><i class="fas fa-phone"></i> {{$service->number}}</li>
                                    <li><i class="fas fa-envelope"></i> {{$service->email}}</li>
                                </ul>
                                <a href="{{Route('detailsservices', [$service->category->name, $service->name])}}"
                                    class="btn btn-outline-dark w-100">Book Now</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row" id="filtered"></div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="info-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="info-box">
                        <div class="info-icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <h3 class="info-title">Premium Fleet</h3>
                        <p class="info-text">We offer only the highest quality vehicles, meticulously maintained and
                            regularly updated to ensure your comfort and safety.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="info-box">
                        <div class="info-icon">
                            <i class="fas fa-euro-sign"></i>
                        </div>
                        <h3 class="info-title">Best Prices</h3>
                        <p class="info-text">Competitive rates with no hidden fees. We offer transparent pricing and
                            flexible rental options to suit your needs.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="info-box">
                        <div class="info-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="info-title">24/7 Support</h3>
                        <p class="info-text">Our dedicated team is available around the clock to assist you with any
                            questions or needs during your rental period.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="testimonial-section">
        <div class="testimonial-overlay"></div>
        <div class="container">
            <div class="testimonial-content py-5">
                <h2 class="section-title text-white">What Our Clients Say</h2>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="testimonial-card">
                            <p class="testimonial-text">"The Mercedes G Class was perfect for exploring Ibiza in style. The
                                team at Louxi made the whole process seamless."</p>
                            <p class="testimonial-author">- Michael B.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="testimonial-card">
                            <p class="testimonial-text">"Excellent service from start to finish. The Range Rover was
                                immaculate and perfect for our family vacation."</p>
                            <p class="testimonial-author">- Sarah L.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="testimonial-card">
                            <p class="testimonial-text">"Driving the Porsche 911 along Ibiza's coastal roads was a dream
                                come true. Will definitely rent from Louxi again!"</p>
                            <p class="testimonial-author">- David K.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">Ready to Explore Dreams?</h2>
            <p class="cta-text">Book your premium rental car today and experience the island in ultimate comfort and style.
                Our team is ready to assist you with all your transportation needs.</p>
            <a href="#" class="btn btn-primary btn-lg">Book Your Car Now</a>
        </div>
    </section>

@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- GSAP Animations -->
    <script>
        gsap.registerPlugin(ScrollTrigger);
        document.addEventListener('DOMContentLoaded', function () {
            // Hero section animation
            gsap.from('.hero-title', {
                duration: 1,
                y: 50,
                opacity: 0,
                ease: 'power3.out'
            });

            // Reinitialize Owl Carousel for dynamically added car images
            $('#filtered .cars-img-container').each(function () {
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

            gsap.from('.hero-subtitle', {
                duration: 1,
                y: 50,
                opacity: 0,
                delay: 0.3,
                ease: 'power3.out'
            });

            document.addEventListener('DOMContentLoaded', function () {
                gsap.from('.btn-primary', {
                    duration: 1,
                    y: 50,
                    opacity: 0,
                    delay: 0.6,
                    ease: 'power3.out'
                });
            });

            // Cars section animation
            gsap.from('.section-title', {
                scrollTrigger: {
                    trigger: '.section-title',
                    start: 'top 80%'
                },
                duration: 1,
                y: 50,
                opacity: 0,
                ease: 'power3.out',
            });

            ScrollTrigger.batch('.car-card', {
                start: 'top 80%',
                onEnter: batch => {
                    gsap.fromTo(batch,
                        { y: 50, opacity: 0 },
                        { y: 0, opacity: 1, duration: 0.5, stagger: 0.2, ease: 'power3.out' }
                    );
                },
                onEnterBack: batch => {
                    gsap.fromTo(batch,
                        { y: 50, opacity: 0 },
                        { y: 0, opacity: 1, duration: 0.5, stagger: 0.2, ease: 'power3.out' }
                    );
                },
                onLeave: batch => {
                    gsap.set(batch, { opacity: 0, y: 50 });
                }
            });

            // Info section animation
            gsap.from('.info-box', {
                scrollTrigger: {
                    trigger: '.info-box',
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

            // Initialize Owl Carousel for car images
        });
      
    </script>

    <script>
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
            // Initialize states on page load
          

        });

        loadStates();

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
            url: '{{ route('cars.filter') }}',
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
                if (response.status== 'success') {
                // Hide existing stays instead of removing them
                $('#unfiltered').hide();

                // Append filtered stays
                response.data.forEach(function (stay) {
                    var stayHtml = `
                    <div class="col-lg-4 col-md-6 mb-4 filtered">
                        <div class="car-card">
                        <div id="carousel-${stay.id}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                            ${(Array.isArray(stay.service_images) ? stay.service_images : JSON.parse(stay.service_images || '[]')).map((image, index) => `
                                <div class="carousel-item ${index === 0 ? 'active' : ''}">
                                <img src="${image}" class="d-block w-100 car-img" alt="Car Image">
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
                        <div class="card-body text-center">
                            <h3 class="car-title">${stay.name}</h3>
                            <ul class="car-features list-unstyled text-start">
                            <li><i class="fas fa-car"></i> Doors: ${stay.doors || 'N/A'}</li>
                            <li><i class="fas fa-cogs"></i> Transmission: ${stay.transmission || 'N/A'}</li>
                            <li><i class="fas fa-gas-pump"></i> Fuel Type: ${stay.fuel_type || 'N/A'}</li>
                  
                            </ul>
                            <a href="/${stay.category_id}/${stay.service_id}/${stay.type_id}/${stay.id}/conformbooking" class="btn btn-outline-dark w-100">Book Now</a>
                        </div>
                        </div>
                    </div>`;
                    $('#filtered').append(stayHtml);
                });
                } 
                else {
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
@endsection