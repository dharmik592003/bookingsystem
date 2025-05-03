@extends('layout.layout')
<!-- GSAP -->
@section('style')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
  <style>
    /* Minimal necessary CSS only for full viewport sections */
    .full-viewport {
    height: 100vh;
    width: 100%;
    }
  </style>
@endsection
@section('main')
  <section class="full-viewport position-relative overflow-hidden">
    <video autoplay muted loop class="position-absolute w-100 h-100 d-none d-md-block"
    style="object-fit: cover; z-index: -1;">
    <source src="{{ asset('videos/website-fulld-vertical_MeI6V5cX (online-video-cutter.com) (1).mp4') }}"
      type="video/mp4">
    </video>
    <video autoplay muted loop class="position-absolute w-100 h-100 d-block d-md-none"
    style="object-fit: cover; z-index: -1;">
    <source src="{{ asset('videos/Website_FullHD_Horizontal.MP4') }}" type="video/mp4">
    </video>
    <div class="container h-100 d-flex align-items-center">
    <div class="row">
      <div class="col-12 text-center text-white">
      <h1 class="display-1 fw-bold mb-4">ELVIN <span class="text-warning">INDIA</span></h1>
      <p class="lead mb-5">Experience the luxury of Elvin in the heart of India</p>
      <a class="btn btn-outline-light btn-lg px-5" href="#services" >Explore</a>
      </div>
    </div>
    </div>
  </section>




  <!-- Properties Section -->
  <section class="full-viewport bg-white position-relative overflow-hidden" id='services'>
    <div class="container h-100 d-flex align-items-center">
    <div class="row">
      <div class="col-12 text-center mb-5">
      <h2 class="display-4 fw-bold">Our Services</h2>
      <p class="lead">Discover the exceptional experiences of Elvin India</p>
      </div>
      @foreach ($services as $service)
      <div class="col-md-3 text-center">
      <div class="card border-0">
      <div class="img-contai" style="height: 300px;">
      <img src="{{ asset($service['photo']) }}" class="card-img-top img-fluid" alt="{{ $service['name'] }}">
      </div>
      <div class="card-body">
      <h5 class="card-title text-uppercase">{{ $service['name'] }}</h5>
      <p class="card-text">{{ $service['desc'] }}</p>
      <a href="/{{ $service['name'] }}" class="btn btn-outline-primary">VIEW DETAILS →</a>
      </div>
      </div>
      </div>
    @endforeach
    </div>
    </div>
  </section>





  <!-- About Section -->


  <section class="full-viewport bg-light position-relative overflow-hidden m-5">
    <h1 class="text-center">About Elvin India</h1>
    <div class="container h-100 d-flex align-items-center">
    <div class="row align-items-center">
      <div class="col-md-6">
      <h2 class="display-4 fw-bold mb-4">About Elvin India</h2>
      <p class="lead">Elvin India brings world-class hospitality to the vibrant culture of India, offering
        unparalleled luxury experiences.</p>
      <p>Our properties combine contemporary design with traditional Indian elements, creating unique spaces that
        celebrate both modernity and heritage.</p>
      </div>
      <div class="col-md-6">
      <img src="{{ asset('images/about us.png') }}" alt="Elvin India Property" class="img-fluid rounded shadow">
      </div>
    </div>
    </div>
  </section>


  <!-- Experience Section -->


  <!-- Contact Section -->
  <section class="container-fluid bg-dark text-white ">
    <div class="row p-5 justify-content-between">
    <div class="col-xl-6">
      <h2 class="display-4 fw-bold mb-4">Contact Elvin India</h2>
      <p class="lead">Ready to experience luxury redefined?</p>
      <p>Our team is available to assist with reservations and inquiries.</p>
    </div>

    <div class="col-xl-6">
      <form>
      <div class="mb-3">
        <input type="text" class="form-control form-control-lg" placeholder="Your Name">
      </div>
      <div class="mb-3">
        <input type="email" class="form-control form-control-lg" placeholder="Email Address">
      </div>
      <div class="mb-3">
        <textarea class="form-control form-control-lg" rows="3" placeholder="Your Message"></textarea>
      </div>
      <button type="submit" class="btn btn-outline-light btn-lg w-100">Send Message</button>
      </form>
    </div>
    </div>  
  </section>
@endsection
@section('script')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    <!-- GSAP Animations -->
    window.onload = function () {
    // Register ScrollTrigger plugin
    gsap.registerPlugin(ScrollTrigger);
    window.onload = function () {
      // Simple animations for each section
      gsap.from('section:nth-child(1) h1', { duration: 1.5, y: 50, opacity: 0, ease: "power3.out" });
      gsap.from('section:nth-child(1) p', { duration: 1.5, y: 50, opacity: 0, ease: "power3.out", delay: 0.3 });
      gsap.from('section:nth-child(1) button', { duration: 1.5, y: 50, opacity: 0, ease: "power3.out", delay: 0.6 });

      gsap.from('section:nth-child(2) h2', {
      duration: 1, x: -50, opacity: 0, scrollTrigger: {
        trigger: 'section:nth-child(2)',
        start: "top 80%"
      }
      });
      gsap.from('section:nth-child(2) p', {
      duration: 1, x: -50, opacity: 0, delay: 0.3, scrollTrigger: {
        trigger: 'section:nth-child(2)',
        start: "top 80%"
      }
      });
      gsap.from('section:nth-child(2) img', {
      duration: 1, x: 50, opacity: 0, scrollTrigger: {
        trigger: 'section:nth-child(2)',
        start: "top 80%"
      }
      });

      gsap.from('section:nth-child(3) .card', {
      duration: 1, y: 100, opacity: 0, stagger: 0.2, scrollTrigger: {
        trigger: 'section:nth-child(3)',
        start: "top 80%"
      }
      });

      gsap.from('section:nth-child(4) .col-md-3', {
      duration: 1, y: 100, opacity: 0, stagger: 0.1, scrollTrigger: {
        trigger: 'section:nth-child(4)',
        start: "top 80%"
      }
      });

      gsap.from('section:nth-child(5) form', {
      duration: 1, y: 50, opacity: 0, scrollTrigger: {
        trigger: 'section:nth-child(5)',
        start: "top 80%"
      }
      });
    };
    }
  </script>
@endsection