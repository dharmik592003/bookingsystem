@extends('layout.layout')
@section('style')
  <style>
    .card-header {
    font-weight: bold;
    font-size: 1.2rem;
    }

    .card-body p {
    margin-bottom: 0.5rem;
    }

    .otp-section {
    margin-top: 2rem;
    }
  </style>
@endsection
@section('main')
  @php
    function formatNumberShort($number)
    {
    if ($number >= 1000000000) {
    return round($number / 1000000000, 1) . 'B';
    } elseif ($number >= 1000000) {
    return round($number / 1000000, 1) . 'M';
    } elseif ($number >= 1000) {
    return round($number / 1000, 1) . 'K';
    } else {
    return $number;
    }
    }
    $datas = (object) $info;
    if ($services[0]->category_id == 1) {
    $fields = ['Name', 'beds', 'baths', 'guests', 'amenities'];
    } 
    elseif ($services[0]->category_id == 2) {
    $fields = ['Name', 'seats', 'fuel_type', 'transmission', 'doors'];

    } 
    elseif ($services[0]->category_id == 3) {
    $fields = ['Name', 'length', 'cabins', 'guests', 'amenities'];
    } 
    elseif ($services[0]->category_id == 4) {
    $fields = ['Name', 'duration_hours', 'capacity', 'amenities'];
    }

    $data = [];
    foreach ($fields as $field) {
    $data[$field] = $services[0]->$field;
    }

    $subserv = array_merge($data, (array) $datas);
    $subserv = array_merge($data, (array) $datas, ['days' => (int) $totalHours]);

  @endphp
  @if($services[0]->category_id == 1)
    <div class="container mt-5">
    <div class="row">
    <!-- Booking Information -->
    <div class="col-md-6 mb-4">
      <div class="card shadow">
      <div class="card-header bg-primary text-white">
      Booking Information
      </div>
      <div class="card-body">
      <div class="mb-3">
      <h5 class="text-muted">Service Details</h5>
      <hr class="my-2">
      <div class="row">
        <div class="col-md-6">
        <p><strong>Name:</strong> {{ $services[0]->Name }}</p>
        <p><strong>Duration:</strong> {{round($days)  }} {{ $services[0]->type->booking_type }}</p>
        </div>
        <div class="col-md-6">
        <p><strong>Price:</strong> {{ $services[0]->type->price }} ₹/{{ $services[0]->type->booking_type }}</p>
        <p><strong>Total:</strong> {{ $bill }} ₹</p>
        </div>
      </div>
      </div>
      <div class="mb-3">
      <h5 class="text-muted">Description</h5>
      <hr class="my-2">
      <p class="text-justify">{{ $services[0]->desc }}</p>
      </div>
      <div class="mb-3">
      <h5 class="text-muted">Additional Information</h5>
      <hr class="my-2">
      <ul class="list-group">
        @foreach ($datas as $key => $data)
      <li class="list-group-item d-flex justify-content-between align-items-center">
      <span>{{ $key }}:</span>
      <span class="badge bg-primary rounded-pill">{{ $data }}</span>
      </li>
    @endforeach
      </ul>
      </div>
      </div>
      </div>
    </div>

    <!-- Service Details -->
    <div class="col-md-6 mb-4">
      <div class="card shadow">
      <div class="card-header bg-info text-white">
      Service Details
      </div>
      <div class="card-body">
      <p><strong>Name:</strong> {{ $services[0]->Name }}</p>

      <p><strong>Price:</strong> {{ $services[0]->type->price }} ₹/{{ $services[0]->type->booking_type }}</p>

      <p><strong>Additional Info:</strong></p>
      <ul>
      @foreach ($subserv as $key => $data)
      <li>{{ $key }}: {{ $data }}</li>
    @endforeach
      </ul>
      </div>
      </div>
      <div class="otp-section">
      <div class="card shadow">
      <div class="card-header bg-success text-white">
      OTP Verification
      </div>
      <div class="card-body">
      <form id="email-form">
        <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" value="dharmikjani503@gmail.com"
        placeholder="Enter your email">
        </div>
        <button type="submit" class="btn btn-primary">Send OTP</button>
      </form>

      <form id="otp-form" style="display: none;">
        <div class="mb-3">
        <label for="otp" class="form-label">Enter OTP</label>
        <input type="text" class="form-control" id="otp" placeholder="Enter OTP">
        </div>
        <button type="submit" class="btn btn-success">Verify OTP</button>
      </form>

      <div id="payment-success" style="display: none;">
        <p class="text-success">Payment successful! Your booking is confirmed.</p>
      </div>
      </div>
      </div>
      </div>
    </div>
    </div>

    <!-- OTP Section -->

    </div>
  @elseif($services[0]->category_id == 2)
    <div class="container mt-5">
    <div class="row">
    <!-- Booking Information -->
    <div class="col-md-6 mb-4">
      <div class="card shadow">
      <div class="card-header bg-primary text-white">
      Booking Information
      </div>
      <div class="card-body">
      <div class="mb-3">
      <h5 class="text-muted">Service Details</h5>
      <hr class="my-2">
      <div class="row">
        <div class="col-md-6">
        <p><strong>Name:</strong> {{ $services[0]->Name }}</p>
        <p><strong>Duration:</strong>
        @if(round($days) > 0)
      {{ round($days) }} / days
    @else
    {{ round($days) }} {{ $services[0]->type->booking_type }}
  @endif
        </p>
        </div>
        <div class="col-md-6">
        <p><strong>Price:</strong> {{ $services[0]->type->price }} ₹/{{ $services[0]->type->booking_type }}</p>
        <p><strong>Total:</strong> {{ $bill }} ₹</p>
        </div>
      </div>
      </div>
      <div class="mb-3">
      <h5 class="text-muted">Description</h5>
      <hr class="my-2">
      <p class="text-justify">{{ $services[0]->desc }}</p>
      </div>
      <div class="mb-3">
      <h5 class="text-muted">Additional Information</h5>
      <hr class="my-2">
      <ul class="list-group">
        @foreach ($datas as $key => $data)
      <li class="list-group-item d-flex justify-content-between align-items-center">
      <span>{{ $key }}:</span>
      <span class="badge bg-primary rounded-pill">{{ $data }}</span>
      </li>
    @endforeach
      </ul>
      </div>
      </div>
      </div>
    </div>

    <!-- Service Details -->
    <div class="col-md-6 mb-4">
      <div class="card shadow">
      <div class="card-header bg-info text-white">
      Service Details
      </div>
      <div class="card-body">
      <p><strong>Name:</strong> {{ $services[0]->Name }}</p>

      <p><strong>Price:</strong> {{ $services[0]->get_type->price }} ₹/{{ $services[0]->get_type->booking_type }}</p>

      <p><strong>Additional Info:</strong></p>
      <ul>
      @foreach ($subserv as $key => $data)
      <li>{{ $key }}: {{ $data }}</li>
    @endforeach
      </ul>
      </div>
      </div>
      <div class="otp-section">
      <div class="card shadow">
      <div class="card-header bg-success text-white">
      OTP Verification
      </div>
      <div class="card-body">
      <form id="email-form">
        <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" value="dharmikjani503@gmail.com"
        placeholder="Enter your email">
        </div>
        <button type="submit" class="btn btn-primary">Send OTP</button>
      </form>

      <form id="otp-form" style="display: none;">
        <div class="mb-3">
        <label for="otp" class="form-label">Enter OTP</label>
        <input type="text" class="form-control" id="otp" placeholder="Enter OTP">
        </div>
        <button type="submit" class="btn btn-success">Verify OTP</button>
      </form>

      <div id="payment-success" style="display: none;">
        <p class="text-success">Payment successful! Your booking is confirmed.</p>
      </div>
      </div>
      </div>
      </div>
    </div>
    </div>

    <!-- OTP Section -->

    </div>
  @elseif($services[0]->category_id == 3)
    <div class="container mt-5">
    <div class="row">
    <!-- Booking Information -->
    <div class="col-md-6 mb-4">
      <div class="card shadow">
      <div class="card-header bg-primary text-white">
      Booking Information
      </div>
      <div class="card-body">
      <div class="mb-3">
      <h5 class="text-muted">Service Details</h5>
      <hr class="my-2">
      <div class="row ">
        <div class="col-xl-6 w-100">
        <p><strong>Name:</strong> {{ $services[0]->Name }}</p>
        <p><strong>Duration:</strong> @if(round($totalHours) > 24)
      {{ round($totalHours / 24) + 1}} / days
    @else
    {{ round($totalHours) }} {{ $services[0]->type->booking_type }}
  @endif
        </p>
        </div>
        <div class="col-xl-12">
        <div class="d-flex flex-row"><strong>Price:</strong>
        <p> {{formatNumberShort($services[0]->type->price)}} ₹/{{ $services[0]->type->booking_type }}</p>
        </div>
        <p><strong>Total:</strong> {{ $bill }} ₹</p>
        </div>
      </div>
      </div>
      <div class="mb-3">
      <h5 class="text-muted">Description</h5>
      <hr class="my-2">
      <p class="text-justify">{{ $services[0]->desc }}</p>
      </div>
      <div class="mb-3">
      <h5 class="text-muted">Additional Information</h5>
      <hr class="my-2">
      <ul class="list-group">
        @foreach ($datas as $key => $data)
      <li class="list-group-item d-flex justify-content-between align-items-center">
      <span>{{ $key }}:</span>
      <span class="badge bg-primary rounded-pill">{{ $data }}</span>
      </li>
    @endforeach
      </ul>
      </div>
      </div>
      </div>
    </div>

    <!-- Service Details -->
    <div class="col-md-6 mb-4">
      <div class="card shadow">
      <div class="card-header bg-info text-white">
      Service Details
      </div>
      <div class="card-body">
      <p><strong>Name:</strong> {{ $services[0]->Name }}</p>

      <p><strong>Price:</strong> {{ formatNumberShort($services[0]->type->price) }}
      ₹/{{ $services[0]->type->booking_type }}</p>

      <p><strong>Additional Info:</strong></p>
      <ul>
      @foreach ($subserv as $key => $data)
      <li>{{ $key }}: {{ $data }}</li>
    @endforeach
      </ul>
      </div>
      </div>
      <div class="otp-section">
      <div class="card shadow">
      <div class="card-header bg-success text-white">
      OTP Verification
      </div>
      <div class="card-body">
      <form id="email-form">
        <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" value="dharmikjani503@gmail.com"
        placeholder="Enter your email">
        </div>
        <button type="submit" class="btn btn-primary">Send OTP</button>
      </form>

      <form id="otp-form" style="display: none;">
        <div class="mb-3">
        <label for="otp" class="form-label">Enter OTP</label>
        <input type="text" class="form-control" id="otp" placeholder="Enter OTP">
        </div>
        <button type="submit" class="btn btn-success">Verify OTP</button>
      </form>

      <div id="payment-success" style="display: none;">
        <p class="text-success">Payment successful! Your booking is confirmed.</p>
      </div>
      </div>
      </div>
      </div>
    </div>
    </div>

    <!-- OTP Section -->

    </div>
  @elseif($services[0]->category_id == 4)
    <div class="container mt-5">
    <div class="row">
    <!-- Booking Information -->
    <div class="col-md-6 mb-4">
      <div class="card shadow">
      <div class="card-header bg-primary text-white">
      Booking Information
      </div>
      <div class="card-body">
      <div class="mb-3">
      <h5 class="text-muted">Service Details</h5>
      <hr class="my-2">
      <div class="row">
        <div class="col-md-6">
        <p><strong>Name:</strong> {{ $services[0]->Name }}</p>
        <p><strong>Duration:</strong> {{ round($days)  }} {{ $services[0]->type->booking_type }}</p>
        </div>
        <div class="col-md-6">
        <p><strong>Price:</strong> {{ $services[0]->type->price }} ₹/{{ $services[0]->type->booking_type }}</p>
        <p><strong>Total:</strong> {{ $bill }} ₹</p>
        </div>
      </div>
      </div>
      <div class="mb-3">
      <h5 class="text-muted">Description</h5>
      <hr class="my-2">
      <p class="text-justify">{{ $services[0]->desc }}</p>
      </div>
      <div class="mb-3">
      <h5 class="text-muted">Additional Information</h5>
      <hr class="my-2">
      <ul class="list-group">
        @foreach ($datas as $key => $data)
      <li class="list-group-item d-flex justify-content-between align-items-center">
      <span>{{ $key }}:</span>
      <span class="badge bg-primary rounded-pill">{{ $data }}</span>
      </li>
    @endforeach
      </ul>
      </div>
      </div>
      </div>
    </div>

    <!-- Service Details -->
    <div class="col-md-6 mb-4">
      <div class="card shadow">
      <div class="card-header bg-info text-white">
      Service Details
      </div>
      <div class="card-body">
      <p><strong>Name:</strong> {{ $services[0]->Name }}</p>

      <p><strong>Price:</strong> {{ $services[0]->type->price }} ₹/{{ $services[0]->type->booking_type }}</p>

      <p><strong>Additional Info:</strong></p>
      <ul>
      @foreach ($subserv as $key => $data)
      <li>{{ $key }}: {{ $data }}</li>
    @endforeach
      </ul>
      </div>
      </div>
      <div class="otp-section">
      <div class="card shadow">
      <div class="card-header bg-success text-white">
      OTP Verification
      </div>
      <div class="card-body">
      <form id="email-form">
        <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" value="dharmikjani503@gmail.com"
        placeholder="Enter your email">
        </div>
        <button type="submit" class="btn btn-primary">Send OTP</button>
      </form>

      <form id="otp-form" style="display: none;">
        <div class="mb-3">
        <label for="otp" class="form-label">Enter OTP</label>
        <input type="text" class="form-control" id="otp" placeholder="Enter OTP">
        </div>
        <button type="submit" class="btn btn-success">Verify OTP</button>
      </form>

      <div id="payment-success" style="display: none;">
        <p class="text-success">Payment successful! Your booking is confirmed.</p>
      </div>
      </div>
      </div>
      </div>
    </div>
    </div>

    <!-- OTP Section -->

    </div>
  @endif
@endsection

@section('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $('#email-form').submit(function (e) {
    e.preventDefault();
    var email = $('#email').val();
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      type: 'POST',
      url: '/send-otp',
      headers: {
      'X-CSRF-TOKEN': token
      },
      data: {
      email: email,
      desc: @json($subserv)
      },
      success: function (response) {
      if (response.status === 'Success') {
        alert('OTP sent successfully');
        $('#email-form').hide();
        $('#otp-form').show();
      } else {
        alert('Failed to send OTP: ' + response.message);
      }
      },
      error: function (xhr, status, error) {
      alert('Failed to send OTP: ' + xhr.responseText);
      }
    });
    });

    $('#otp-form').submit(function (e) {
    e.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content');
    var otp = $('#otp').val();
    var email = $('#email').val();
    $.ajax({
      type: 'POST',
      url: '/verify-otp',
      headers: {
      'X-CSRF-TOKEN': token
      },
      data: {
      otp: otp,
      email: email

      },
      success: function (response) {
      console.log(response);
      if (response.status === 'Success') {
        alert('OTP verified successfully');
        $('#email-form').hide();
        $('#otp-form').hide();
        $('#payment-success').show();
        $.ajax({
        type: 'POST',
        url: '/{{ Session::get('booking_id') }}/status',
        headers: {
          'X-CSRF-TOKEN': token
        },
        data: {
          status: 'APPROVED',


        },
        success: function (response) {
          if (response.Success) {
          console.log('Booking is done');
          } else {
          console.log('Booking failed');
          }
        }
        });
      } else {
        alert('Invalid OTP');
      }
      },
      error: function (xhr, status, error) {
      console.log(xhr.responseText);
      }
    });
    });
  </script>
@endsection