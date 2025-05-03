@extends('layout.layout')
@section('style')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="{{asset('css/style.css')}}" />
  <style>
    .owl-nav {
    margin: 0 !important;
    padding: 0 !important;
    }

    .slide-image {
    overflow: hidden;
    border-radius: 20px;
    }

    .lable h1 {
    font-size: 30px;
    font-weight: 600;
    color: black;
    }

    .card {
    border-radius: 20px !important;
    box-shadow: 0.5px 0.5px 3px 0.5px #000000;
    }

    .img-carousel-row {
    box-shadow: 0px 1px 0px 0px #000000;
    border-radius: 10px;
    }

    .owl-carousel .nav-button {
    height: 50px;
    width: 25px;
    cursor: pointer;
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
  </style>

@endsection
@section('main')
  <div class="container-fluid">
    <div class="appheader">
    <div class="container-fluid">
      <div class="row">
      <div class="col-lg-12 col-6">
        <!--begin::Small Box Widget 2-->
        <form id="hmsearchfrm" class="d-flex flex-column align-items-center" action="" style="gap: 10px;"
        method="post">
        <div class="small-box row searchfrm text-bg-primary">
          <div class="inner d-flex">
          <div class="form-col">
            <i class="bi bi-geo-alt"></i>
            <label for="">State</label>
            <div id="inxUsrctyList01" class="has-icon">
            <select name="state_id" onchange="upd()" class="form-select" id="inputState2">
              <option value="">-- Select State --</option>
            </select>
            </div>
            <a href="javascript:;" class="hmdtct1mob"><i class="fa fa-crosshairs"></i></a>
          </div>
          <div class="form-col">
            <i class="bi bi-geo-alt"></i>
            <label for="formSearchUpCity3">City</label>
            <div id="inxUsrctyList01" class="has-icon">
            <select name="city_id" class="form-select" id="inputcities">
              <option value="">-- Select City --</option>
            </select>
            </div>
            <a href="javascript:;" class="hmdtct1mob"><i class="fa fa-crosshairs"></i>
            </a>
          </div>
          <div class="form-col">
            <i class="bi bi-calendar"></i>
            <label for="">Pick Up Date</label>
            <div>
            <input type="date" class="" name="picking_up_date" style="height:36px;
      border-radius:5px; border:0px;" value="2025-02-24" id="pckdateNsd" autocomplete="off" min="2025-02-24"
              aria-label="pick up date">
            </div>
          </div>


          <div class="form-col">
            <i class="bi bi-calendar"></i>
            <label for="">Drop Off Date</label>
            <div>
            <input type="date" style="height:36px;
      border-radius:5px; border:0px;" name="dropping_off_date" value="" id="drpdateNsd" autocomplete="off"
              min="2025-02-24" aria-label="drop off date">
            </div>
          </div>

          </div>
          <div class="d-flex justify-content-between">
          <div class="service-filter d-flex justify-content-between">
            @foreach ($services as $service)
        <div class="me-2">
        <input type="checkbox" class="form-check-input" name="category_id[]" autocomplete="off"
          value="{{ $service->id }}">
        <label for="" class="form-check-label">{{$service->name}}</label>

        </div>
      @endforeach
          </div>
          <div class="form-col">
            <button class="btn btn-primary" onclick="clearFilter()">clear filter</button>
            <button type="submit" class="btn btn-success" id="nl_hmseacrhFrmSbmt">Find
            services</button>
          </div>
          </div>
        </form>

        <!--end::Small Box Widget 2-->
      </div>
      </div>
    </div>
    </div>
    <div class="container-fluid" id="contant">
    <div class="row">
      <div class="massage h-10"></div>
      <div id="filtereddata">
      @foreach ($services as $service)
      <div class="img-carousel-row" id="filtered" style="margin-bottom:30px;height:500px;">
      <div class="lable">
      <h1 for="">{{ $service->name}}</h1>
      </div>
      <div class="owl-carousel owl-theme  image-slide ">
      @foreach ($service->getservices as $subservices)
      <div class="card" style="width: 18rem;">
      <div class="slide-image">
      <img src="{{ $subservices->banner_photo }}" alt="" class="img-fluid" alt="image">
      </div>
      <div class="card-body">
      <div class="servic-text ">

      <div class="service-name d-flex flex-column justify-content-center">
      <h1>
        {{ $subservices->name }}
      </h1>
      </div>
      <div class="service-provider">
      <p class="card-text text-center">{{ $subservices->agency->name }}.</p>
      <p lass="card-text text-center">{{ $subservices->desc }}</p>
      </div>
      <div class="service-location d-flex align-items-center justify-content-between">
        <p class="city" value="{{$subservices->city->city_id}}"> {{$subservices->city->name}} </p>
      
        <p class="state" value="{{$subservices->state->state_id}}"> {{$subservices->state->name}}
      </p>
        <p class="country" value="{{$subservices->country->country_id}} ">
        {{$subservices->country->name}}
      </p>
      </div>

      </div>
      <a href="services/{{ $service->name }}/{{ $subservices->name }}" class="btn btn-primary">Check out</a>
      </div>
      </div>
    @endforeach
      </div>
      </div>
    @endforeach
      </div>
    </div>
    </div>

  @endsection

  @section('script')

    <!-- jsvectormap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
    integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
    $(function () {
      // Owl Carousel
      var owl = $(".owl-carousel");
      owl.owlCarousel({
      items: 4,
      dots: false,
      margin: 0,
      loop: true,
      nav: true,
      navText: ["<div class='text-dark nav-button d-flex owl-prev'>&larr;</div>", "<div class='text-dark nav-button d-flex owl-next'>&rarr;</div>"]
      });
    });

    </script>

    <!-- ChartJS -->
    <script>
    function updateTextInput() {
      const xhr = new XMLHttpRequest();

      $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      url: '/sendstates',
      data: { 'id': 102 },
      type: "get",
      cache: false,
      success: function (response) {
        console.log(response);
        $('#inputState2').html('<option value="">-- Select State --</option>');
        $.each(response.id, function (key, value) {
        $("#inputState2").append('<option value="' + value.id + '">' + value.name + '</option>');
        });
      },
      error: function (response) {
        console.log('not done');
      }
      });
    }

    $(document).ready(function () {
      updateTextInput();
    });

    function upd() {
      const xhr = new XMLHttpRequest();
      var dropdown = document.getElementById('inputState2');
      var dropdown2 = document.getElementById('inputcities');
      var value = dropdown.value;
      console.log(dropdown.value);

      $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      url: '/sendcity',
      data: { 'id': value },
      type: "get",
      cache: false,
      success: function (response) {
        console.log(response);
        $('#inputcities').html('<option value="">-- Select City --</option>');
        $.each(response.id, function (key, value) {
        $("#inputcities").append('<option value="' + value.id + '">' + value.name + '</option>');
        });
      },
      error: function (response) {
        console.log('not done');
      }
      });
    }
    </script>
    <!-- <script>
    $('#hmsearchfrm').submit(function (e) {
      e.preventDefault();y
      var formData = $(this).serializeArray();
      var state_id = formData.find(x => x.name === 'state_id').value;
      var city_id = formData.find(x => x.name === 'city_id').value;
      var picking_up_date = formData.find(x => x.name === 'picking_up_date').value;
      var dropping_off_date = formData.find(x => x.name === 'dropping_off_date').value;
      var category_ids = formData.filter(x => x.name === 'category_id[]').map(x => x.value);
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        url: '/filterServices',
        data: {
          'state_id': state_id,
          'city_id': city_id,
          'category_id': category_ids,
          'picking_up_date': picking_up_date,
          'dropping_off_date': dropping_off_date
        },
        type: "get",
        cache: false,

        success: function (response) {
          if (response.services.length > 0) {
            $('#filtereddata').empty();
            $.each(response.services, function (key, value) {
              var html = '';
              if (value.services.length > 0) {
                html += '<div class="img-carousel-row" style="margin-bottom:30px;height:500px;">';
                html += '<div class="lable">';
                html += '<h1>' + value.category_name + '</h1>';
                html += '</div>';
                html += '<div class="owl-carousel owl-theme image-slide" id="carousel-' + value.category_id + '">';
                $.each(value.services, function (index, service) {
                  var bannerPhotos = [];
                  try {
                    bannerPhotos = JSON.parse(service.banner_photo);
                  } catch (e) {
                    bannerPhotos = [service.banner_photo];
                  }
                  var bannerPhotoUrl = bannerPhotos.length > 0 ? bannerPhotos[0] : '';
                  var categoryName = service.category && service.category.name ? service.category.name : '';
                  var baseUrl = window.location.origin + '/';
                  var fullBannerPhotoUrl = bannerPhotoUrl ? baseUrl + bannerPhotoUrl : '';
                  html += '<div class="card" style="width: 18rem;">';
                  html += '<div class="slide-image">';
                  html += '<img src="' + fullBannerPhotoUrl + '" alt="" class="img-fluid" alt="image">';
                  html += '</div>';
                  html += '<div class="card-body">';
                  html += '<h1>' + service.name + '</h1>';
                  html += '<p class="card-text">' + service.desc + '.</p>';
                  html += '<a href="' + categoryName + '/' + service.name + '" class="btn btn-primary">Check out</a>';
                  html += '</div>';
                  html += '</div>';
                });
                html += '</div>';
                html += '</div>';
              } else {
                html += '<div class="img-carousel-row" style="margin-bottom:30px;height:500px;">';
                html += '<div class="lable">';
                html += '<h1>No services found for ' + value.category_name + '</h1>';
                html += '</div>';
                html += '</div>';
              }
              $('#filtereddata').append(html);
              $("#carousel-" + value.category_id).owlCarousel({
                items: 4,
                dots: false,
                margin: 0,
                loop: true,
                nav: true,
                navText: [
                  "<div class='text-dark nav-button d-flex owl-prev'>&larr;</div>",
                  "<div class='text-dark nav-button d-flex owl-next'>&rarr;</div>"
                ]
              });
            });
          } else {
            $('#filtereddata').html('<h2>No services available, change the service timeline</h2>');
          }
        },
        error: function (xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    });
    </script> -->
    <script>
    function clearFilter() {
      $('#hmsearchfrm')[0].reset();
      $('#filtereddata').css('display', 'block');
      $('.appendeddata').remove();
      $('.massage').html('');
      reinitInnerCarousels();
    }

    function initInnerCarousel(selector) {
      console.log('Initializing inner carousel for', selector);
      $(selector).owlCarousel({
        items: 1,
        dots: true,
        nav: true,
        navText: [
          "<div class='text-dark nav-button d-flex owl-prev'>&larr;</div>",
          "<div class='text-dark nav-button d-flex owl-next'>&rarr;</div>"
        ],
        loop: true,
        margin: 10,
        autoWidth: false,
        autoHeight: true
      });
    }

    function reinitInnerCarousels() {
      $('.inner-image-carousel').each(function () {
        var selector = $(this);
        if (selector.hasClass('owl-loaded')) {
          selector.trigger('destroy.owl.carousel');
          selector.removeClass('owl-loaded');
          selector.find('.owl-stage-outer').children().unwrap();
          selector.removeData();
        }
        initInnerCarousel(this);
      });
    }
    </script>
  <script>





    // Modify AJAX success to call reinitInnerCarousels after updating content
    $('#hmsearchfrm').submit(function (e) {
      e.preventDefault();
      var formData = $(this).serializeArray();
      var state_id = formData.find(x => x.name === 'state_id').value;
      var city_id = formData.find(x => x.name === 'city_id').value;
      var picking_up_date = formData.find(x => x.name === 'picking_up_date').value;
      var dropping_off_date = formData.find(x => x.name === 'dropping_off_date').value;
      var category_ids = formData.filter(x => x.name === 'category_id[]').map(x => x.value);
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        url: '/filterServices',
        data: {
          'state_id': state_id,
          'city_id': city_id,
          'category_id': category_ids,
          'picking_up_date': picking_up_date,
          'dropping_off_date': dropping_off_date
        },
        type: "get",
        cache: false,

        success: function (response) {
          if (response.services.length > 0) {
            $('#filtereddata').empty();
            $.each(response.services, function (key, value) {
              var html = '';
              if (value.services.length > 0) {
                html += '<div class="img-carousel-row" style="margin-bottom:30px;height:500px;">';
                html += '<div class="lable">';
                html += '<h1>' + value.category_name + '</h1>';
                html += '</div>';
                html += '<div class="owl-carousel owl-theme image-slide" id="carousel-' + value.category_id + '">';
                $.each(value.services, function (index, service) {
                  var bannerPhotos = [];
                  try {
                    bannerPhotos = JSON.parse(service.banner_photo);
                  } catch (e) {
                    bannerPhotos = [service.banner_photo];
                  }
                  var bannerPhotoUrl = bannerPhotos.length > 0 ? bannerPhotos[0] : '';
                  var categoryName = service.category && service.category.name ? service.category.name : '';
                  var baseUrl = window.location.origin + '/';
                  var fullBannerPhotoUrl = bannerPhotoUrl ? baseUrl + bannerPhotoUrl : '';
                  html += '<div class="card" style="width: 18rem;">';
                  html += '<div class="slide-image">';
                  html += '<div class="owl-carousel owl-theme inner-image-carousel unique-inner-carousel-' + service.id + '">';
                  $.each(bannerPhotos, function (i, img) {
                    html += '<div class="item" style="width: 100% !important;">';
                    html += '<img src="' + img + '" alt="image" class="img-fluid" />';
                    html += '</div>';
                  });
                  html += '</div>';
                  html += '</div>';
                  html += '<div class="card-body">';
                  html += '<h1>' + service.name + '</h1>';
                  html += '<p class="card-text">' + service.desc + '.</p>';
                  html += '<a href="' + categoryName + '/' + service.name + '" class="btn btn-primary">Check out</a>';
                  html += '</div>';
                  html += '</div>';
                });
                html += '</div>';
                html += '</div>';
              } else {
                html += '<div class="img-carousel-row" style="margin-bottom:30px;height:500px;">';
                html += '<div class="lable">';
                html += '<h1>No services found for ' + value.category_name + '</h1>';
                html += '</div>';
                html += '</div>';
              }
              $('#filtereddata').append(html);
              $("#carousel-" + value.category_id).owlCarousel({
                items: 1,
                dots: false,
                margin: 0,
                loop: true,
                nav: true,
                navText: [
                  "<div class='text-dark nav-button d-flex owl-prev'>&larr;</div>",
                  "<div class='text-dark nav-button d-flex owl-next'>&rarr;</div>"
                ]
              });
            });
            reinitInnerCarousels();
          } else {
            $('#filtereddata').html('<h2>No services available, change the service timeline</h2>');
          }
        },
        error: function (xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    });

    function clearFilter() {
      $('#hmsearchfrm')[0].reset();
      $('#filtereddata').css('display', 'block');
      $('.appendeddata').remove();
      $('.massage').html('');
      reinitInnerCarousels();
    }
  </script>
  @endsection
