@extends('layout.layout')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <style>
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


        .service-booking {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
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
    <div class="row">
        <div class="col-xl-6 service-booking">
            @if(($services->category_id == 1))
                <form class="form-control"
                    action="{{ route('payment.index', [$services->category->id, $services->id, $services->types->id, $stay->id])}}"
                    method="get">
                    <div class="text-center mb-4">
                        <img src="{{asset('img/Group 1.svg')}}" alt="Loux Ibiza Logo">
                    </div>
                    <div class="form">
                        <h1>Book Your Service at</h1>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="agency-name">
                                    <h2>{{ $services->agency->name }}</h2>
                                </div>
                            </div>


                            <div class="col-xl-6 p-0 align-content-center  ">
                                <div class="agency-name d-flex align-items-center  justify-content-between">
                                    <p class="m-0">{{ $services->agency->city->name }} </p>
                                    <p class="m-0">{{ $services->agency->state->name }} </p>
                                    <strong>{{ $services->agency->country->name }}</strong>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer-name">Customer Name:</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" id="customer-name"
                                    placeholder="Enter customer name">
                            </div>
                            <div class="form-group">
                                <label for="customer-email">Customer Email:</label>
                                <input type="email" class="form-control" value="{{ $user->email}}" id="customer-email"
                                    placeholder="Enter customer email">
                            </div>
                            <div class="form-group">
                                <label for="customer-phone">Customer Phone:</label>
                                <input type="text" class="form-control" value="{{ $user->number}}" id="customer-phone"
                                    placeholder="Enter customer phone">
                            </div>

                            <div class="form-group">
                                <div class="d-flex flex-column">
                                    <div class="d-flex lables justify-content-evenly text-center">
                                        <div class="text-center w-100">
                                            <label for="customer-phone">Service name:</label>
                                        </div>
                                        <div class="text-center w-100">
                                            <label for="customer-phone">Service Type:</label>
                                        </div>
                                    </div>
                                    <div class="d-flex fields">
                                        <input type="text" class="text-center form-control" value="{{ $services->name }}"
                                            id="customer-phone" placeholder="Enter customer phone">
                                        <select name="" class='text-center form-control' id="">
                                            <option value="{{ $services->types->id }}">{{ $services->types->name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="form-select" name="" id="guest" placeholder="Guests: tell about the guests "
                                    style="position: relative;">
                                </input>
                                <div class="guest-selector"
                                    style="display: none; position: absolute; background-color: white; width: 300px; padding: 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000;">
                                    <div class="guest-category mb-4">
                                        <div class="d-flex flex-column justify-content-between align-items-center mb-2">
                                            <div class=" d-flex flex-column ">
                                                <div class="d-flex align-content-center justify-content-between">
                                                    <div class="text-center w-100">
                                                        <label for="adults" class="fw-bold">Adults</label>
                                                        <p class="text-muted small mb-0">Age 13+</p>
                                                    </div>
                                                    <div class="controls d-flex align-items-center">
                                                        <button type="button" onclick="decrement('adults')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">-</button>
                                                        <input type="number" id="adults" name="adults" value="1" min="0"
                                                            class="form-control mx-2 text-center" style="width: 50px;">
                                                        <button type="button" onclick="increment('adults')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" d-flex flex-column ">

                                                <div class="d-flex  align-content-center justify-content-between">
                                                    <div class="text-center w-100">
                                                        <label for="children" class="fw-bold">child</label>
                                                        <p class="text-muted small mb-0">Age 2+</p>
                                                    </div>
                                                    <div class="controls d-flex align-items-center">
                                                        <button type="button" onclick="decrement('children')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">-</button>
                                                        <input type="number" id="children" name="children" value="1" min="0"
                                                            class="form-control mx-2 text-center" style="width: 50px;">
                                                        <button type="button" onclick="increment('children')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">+</button>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class=" d-flex flex-column ">
                                                <div class="d-flex align-content-center justify-content-between">
                                                    <div class="text-center ">
                                                        <label for="pets" class="fw-bold">Pets</label>
                                                    </div>
                                                    <div class="controls d-flex align-items-center">
                                                        <button type="button" onclick="decrement('pets')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">-</button>
                                                        <input type="number" id="pets" name="pets" value="0" min="0"
                                                            class="form-control mx-2 text-center" style="width: 50px;">
                                                        <button type="button" onclick="increment('pets')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">+</button>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label for="pets">Pets Bringing a service animal?</label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>





                                <div class="guest-limit-info">
                                    <p>This place has a maximum of 4 guests, not including infants. If you're bringing more
                                        than
                                        2 pets, please let your Host know.</p>
                                </div>


                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-flex flex-column">
                                <div class="lables d-flex justify-content-evenly">
                                    <div class="text-center w-100">
                                        <label for="checkin-date">Check-in Date:</label>
                                    </div>
                                    <div class="text-center w-100">
                                        <label for="checkout-date">Check-out Date:</label>
                                    </div>
                                </div>
                                <div class="d-flex fields">
                                    <input autocomplete="off" type="#" placeholder="dd/mm/yyyy " name="from"
                                        class="text-center form-control" id="from">
                                    <input autocomplete="off" type="#" placeholder="dd/mm/yyyy " name="to"
                                        class="text-center form-control" id="to">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="d-flex flex-column">
                                <div class="lable d-flex justify-content-evenly">
                                    <div class="text-center w-100"> <label for="checkin-time">Check-in Time:</label></div>
                                    <div class="text-center w-100"> <label for="checkout-time">Check-out Time:</label></div>
                                </div>
                                <div class="d-flex fields">
                                    <select class="form-control text-center " value="{{ $services->booking_start }}"
                                        id="checkin-time" name="checkin_time">
                                        <option value="{{ $services->booking_start }}">{{ $services->booking_start }}</option>
                                    </select>

                                    <select class="form-control text-center " value="{{ $services->booking_end }}"
                                        id="checkout-time" name="checkout_time">
                                        <option value="{{ $services->booking_end }}">{{ $services->booking_end }}</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="explore-btn">Make Booking</button>
                        <!-- <a style="color:#d4af37;" id="addtocart" href="">OR ADD to cart to buy multiple services at time! </a> -->
                    </div>
                </form>
            @elseif(($services->category_id == 2))
                <form class="form-control"
                    action="{{ route('payment.index', [$services->category->id, $services->id, $services->types->id, $stay->id])}}"
                    method="get">
                    <div class="text-center mb-4">
                        <img src="{{asset('img/Group 1.svg')}}" alt="Loux Ibiza Logo">
                    </div>
                    <div class="form">
                        <h1>Book Your Service at</h1>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="agency-name">
                                    <h2>{{ $services->agency->name }}</h2>
                                </div>
                            </div>


                            <div class="col-xl-6 p-0 align-content-center  ">
                                <div class="agency-name d-flex align-items-center  justify-content-between">
                                    <p class="m-0">{{ $services->agency->city->name }} </p>
                                    <p class="m-0">{{ $services->agency->state->name }} </p>
                                    <strong>{{ $services->agency->country->name }}</strong>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer-name">Customer Name:</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" id="customer-name"
                                    placeholder="Enter customer name">
                            </div>
                            <div class="form-group">
                                <label for="customer-email">Customer Email:</label>
                                <input type="email" class="form-control" value="{{ $user->email}}" id="customer-email"
                                    placeholder="Enter customer email">
                            </div>
                            <div class="form-group">
                                <label for="customer-phone">Customer Phone:</label>
                                <input type="text" class="form-control" value="{{ $user->number}}" id="customer-phone"
                                    placeholder="Enter customer phone">
                            </div>

                            <div class="form-group">
                                <div class="d-flex flex-column">
                                    <div class="d-flex lables justify-content-evenly text-center">
                                        <div class="text-center w-100">
                                            <label for="customer-phone">Service name:</label>
                                        </div>
                                        <div class="text-center w-100">
                                            <label for="customer-phone">Service Type:</label>
                                        </div>
                                    </div>
                                    <div class="d-flex fields">
                                        <input type="text" class="text-center form-control" value="{{ $services->name }}"
                                            id="customer-phone" placeholder="Enter customer phone">
                                        <select name="" class='text-center form-control' id="">
                                            <option value="{{ $services->types->id }}">{{ $services->types->name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-flex flex-column">
                                    <div class="lables d-flex justify-content-evenly">
                                        <div class="text-center w-100">
                                            <label for="checkin-date">Check-in Date:</label>
                                        </div>
                                        <div class="text-center w-100">
                                            <label for="checkout-date">Check-out Date:</label>
                                        </div>
                                    </div>
                                    <div class="d-flex fields">
                                        <input autocomplete="off" type="#" placeholder="dd/mm/yyyy " name="from"
                                            class="text-center form-control" id="from">
                                        <input autocomplete="off" type="#" placeholder="dd/mm/yyyy " name="to"
                                            class="text-center form-control" id="to">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-none" id="cars">



                                <div class="guest-category mb-4">
                                    <div class="d-flex flex-column justify-content-between align-items-center mb-2">
                                        <div class=" d-flex flex-column ">
                                            <div class="d-flex align-content-center  justify-content-between">
                                                <div class="text-center d-flex flex-column w-100">
                                                    <label for="adults" class="fw-bold">with driver</label>
                                                    <label for="pets" class="fw-bold">long trip</label>
                                                    <label for="children" class="fw-bold">daily ride</label>
                                                </div>
                                                <div class="controls d-flex  flex-column align-items-center">

                                                    <input type="checkbox" id="" name="driver" value="1"
                                                        class="form-check-input form-control mx-2 text-center"
                                                        style="width: 50px;">
                                                    <input type="checkbox" id="" name="longtrip" value="1"
                                                        class="form-check-input form-control mx-2 text-center"
                                                        style="width: 50px;">
                                                    <input type="checkbox" id="pets" name="dailyride" value="1"
                                                        class="form-check-input form-control mx-2 text-center"
                                                        style="width: 50px;">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                            </div>

                            <div class="form-group">
                                <div class="d-flex flex-column">
                                    <div class="lable d-flex justify-content-evenly">
                                        <div class="text-center w-100"> <label for="checkin-time">Check-in Time:</label></div>
                                        <div class="text-center w-100"> <label for="checkout-time">Check-out Time:</label></div>
                                    </div>
                                    <div class="d-flex fields">
                                        <select class="form-control text-center " id="checkin-time" name="checkin_time">
                                            <option value="">select-time</option>

                                        </select>

                                        <select class="form-control text-center " id="checkout-time" name="checkout_time">
                                            <option value="">select-time</option>


                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="explore-btn">Make Booking</button>
                            <!-- <a style="color:#d4af37;" id="addtocart" href="">OR ADD to cart to buy multiple services at time! </a> -->
                        </div>
                    </div>
                </form>
                <!-- <a style="color:#d4af37;" id="addtocart" href="">OR ADD to cart to buy multiple services at time! </a> -->

            @elseif(($services->category_id == 4))
            <form class="form-control"
                    action="{{ route('payment.index', [$services->category->id, $services->id, $services->types->id, $stay->id])}}"
                    method="get">
                    <div class="text-center mb-4">
                        <img src="{{asset('img/Group 1.svg')}}" alt="Loux Ibiza Logo">
                    </div>
                    <div class="form">
                        <h1>Book Your Service at</h1>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="agency-name">
                                    <h2>{{ $services->agency->name }}</h2>
                                </div>
                            </div>


                            <div class="col-xl-6 p-0 align-content-center  ">
                                <div class="agency-name d-flex align-items-center  justify-content-between">
                                    <p class="m-0">{{ $services->agency->city->name }} </p>
                                    <p class="m-0">{{ $services->agency->state->name }} </p>
                                    <strong>{{ $services->agency->country->name }}</strong>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer-name">Customer Name:</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" id="customer-name"
                                    placeholder="Enter customer name">
                            </div>
                            <div class="form-group">
                                <label for="customer-email">Customer Email:</label>
                                <input type="email" class="form-control" value="{{ $user->email}}" id="customer-email"
                                    placeholder="Enter customer email">
                            </div>
                            <div class="form-group">
                                <label for="customer-phone">Customer Phone:</label>
                                <input type="text" class="form-control" value="{{ $user->number}}" id="customer-phone"
                                    placeholder="Enter customer phone">
                            </div>

                            <div class="form-group">
                                <div class="d-flex flex-column">
                                    <div class="d-flex lables justify-content-evenly text-center">
                                        <div class="text-center w-100">
                                            <label for="customer-phone">Service name:</label>
                                        </div>
                                        <div class="text-center w-100">
                                            <label for="customer-phone">Service Type:</label>
                                        </div>
                                    </div>
                                    <div class="d-flex fields">
                                        <input type="text" class="text-center form-control" value="{{ $services->name }}"
                                            id="customer-phone" placeholder="Enter customer phone">
                                        <select name="" class='text-center form-control' id="">
                                            <option value="{{ $services->types->id }}">{{ $services->types->name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="form-select" name="" id="guest" placeholder="Guests: tell about the guests "
                                    style="position: relative;">
                                </input>
                                <div class="guest-selector"
                                    style="display: none; position: absolute; background-color: white; width: 300px; padding: 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000;">
                                    <div class="guest-category mb-4">
                                        <div class="d-flex flex-column justify-content-between align-items-center mb-2">
                                            <div class=" d-flex flex-column ">
                                                <div class="d-flex align-content-center justify-content-between">
                                                    <div class="text-center w-100">
                                                        <label for="adults" class="fw-bold">Adults</label>
                                                        <p class="text-muted small mb-0">Age 13+</p>
                                                    </div>
                                                    <div class="controls d-flex align-items-center">
                                                        <button type="button" onclick="decrement('adults')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">-</button>
                                                        <input type="number" id="adults" name="adults" value="1" min="0"
                                                            class="form-control mx-2 text-center" style="width: 50px;">
                                                        <button type="button" onclick="increment('adults')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" d-flex flex-column ">

                                                <div class="d-flex  align-content-center justify-content-between">
                                                    <div class="text-center w-100">
                                                        <label for="children" class="fw-bold">child</label>
                                                        <p class="text-muted small mb-0">Age 2+</p>
                                                    </div>
                                                    <div class="controls d-flex align-items-center">
                                                        <button type="button" onclick="decrement('children')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">-</button>
                                                        <input type="number" id="children" name="children" value="1" min="0"
                                                            class="form-control mx-2 text-center" style="width: 50px;">
                                                        <button type="button" onclick="increment('children')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">+</button>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class=" d-flex flex-column ">
                                                <div class="d-flex align-content-center justify-content-between">
                                                    <div class="text-center ">
                                                        <label for="pets" class="fw-bold">Pets</label>
                                                    </div>
                                                    <div class="controls d-flex align-items-center">
                                                        <button type="button" onclick="decrement('pets')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">-</button>
                                                        <input type="number" id="pets" name="pets" value="0" min="0"
                                                            class="form-control mx-2 text-center" style="width: 50px;">
                                                        <button type="button" onclick="increment('pets')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">+</button>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label for="pets">Pets Bringing a service animal?</label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>





                                <div class="guest-limit-info">
                                    <p>This place has a maximum of 4 guests, not including infants. If you're bringing more
                                        than
                                        2 pets, please let your Host know.</p>
                                </div>


                            </div>

                            <div class="form-group">
                                <div class="d-flex flex-column">
                                    <div class="lable d-flex justify-content-evenly">
                                        <div class="text-center w-100"> <label for="Departure">Departure</label></div>
                                        <div class="text-center w-100"> <label for="Arrival">Arrival</label></div>
                                    </div>
                                    <div class="d-flex fields">
                                        <select class="form-control text-center " id="Departure" name="Departure">
                                            <option value="">Departure</option>
                                            @foreach ($ports as $port )
                                            
                                            <option value="{{ $port->id }}">{{ $port->Name }}</option>
                                            @endforeach

                                        </select>

                                        <select class="form-control text-center " id="Arrival" name="Arrival">
                                            <option value="">Arrival</option>
                                            @foreach ($ports as $port )
                                            
                                            <option value="{{ $port->id }}">{{ $port->Name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="d-flex flex-column">
                                    <div class="lables d-flex justify-content-evenly">
                                        <div class="text-center w-100">
                                            <label for="checkin-date">Check-in Date:</label>
                                        </div>
                                        <div class="text-center w-100">
                                            <label for="checkout-date" style="opacity: 0;">Check-out Date:</label>
                                        </div>
                                    </div>
                                    <div class="d-flex fields">
                                        <input autocomplete="off" type="#" placeholder="dd/mm/yyyy " name="from"
                                            class="text-center form-control" id="from">
                                        <input autocomplete="off" type="#" placeholder="dd/mm/yyyy " name="to"
                                            class="text-center form-control" style="opacity: 0;" id="to">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-flex flex-column">
                                    <div class="lable d-flex justify-content-evenly">
                                        <div class="text-center w-100"> <label for="checkin-time">Check-in Time:</label></div>
                                        <div class="text-center w-100"> <label for="checkout-time">Check-out Time:</label></div>
                                    </div>
                                    <div class="d-flex fields">
                                        <select class="form-control text-center " id="checkin-time" name="checkin_time">
                                            <option value="">select-time</option>

                                        </select>

                                        <select class="form-control text-center " id="checkout-time" name="checkout_time">
                                            <option value="">select-time</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="explore-btn">Make Booking</button>
                            <!-- <a style="color:#d4af37;" id="addtocart" href="">OR ADD to cart to buy multiple services at time! </a> -->
                        </div>
                    </div>
                </form>
            @elseif(($services->category_id == 3))
                <form class="form-control"
                    action="{{ route('payment.index', [$services->category->id, $services->id, $services->types->id, $stay->id])}}"
                    method="get">
                    <div class="text-center mb-4">
                        <img src="{{asset('img/Group 1.svg')}}" alt="Loux Ibiza Logo">
                    </div>
                    <div class="form">
                        <h1>Book Your Service at</h1>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="agency-name">
                                    <h2>{{ $services->agency->name }}</h2>
                                </div>
                            </div>


                            <div class="col-xl-6 p-0 align-content-center  ">
                                <div class="agency-name d-flex align-items-center  justify-content-between">
                                    <p class="m-0">{{ $services->agency->city->name }} </p>
                                    <p class="m-0">{{ $services->agency->state->name }} </p>
                                    <strong>{{ $services->agency->country->name }}</strong>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer-name">Customer Name:</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" id="customer-name"
                                    placeholder="Enter customer name">
                            </div>
                            <div class="form-group">
                                <label for="customer-email">Customer Email:</label>
                                <input type="email" class="form-control" value="{{ $user->email}}" id="customer-email"
                                    placeholder="Enter customer email">
                            </div>
                            <div class="form-group">
                                <label for="customer-phone">Customer Phone:</label>
                                <input type="text" class="form-control" value="{{ $user->number}}" id="customer-phone"
                                    placeholder="Enter customer phone">
                            </div>

                            <div class="form-group">
                                <div class="d-flex flex-column">
                                    <div class="d-flex lables justify-content-evenly text-center">
                                        <div class="text-center w-100">
                                            <label for="customer-phone">Service name:</label>
                                        </div>
                                        <div class="text-center w-100">
                                            <label for="customer-phone">Service Type:</label>
                                        </div>
                                    </div>
                                    <div class="d-flex fields">
                                        <input type="text" class="text-center form-control" value="{{ $services->name }}"
                                            id="customer-phone" placeholder="Enter customer phone">
                                        <select name="" class='text-center form-control' id="">
                                            <option value="{{ $services->types->id }}">{{ $services->types->name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="form-select" name="" id="guest" placeholder="Guests: tell about the guests "
                                    style="position: relative;">
                                </input>
                                <div class="guest-selector"
                                    style="display: none; position: absolute; background-color: white; width: 300px; padding: 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000;">
                                    <div class="guest-category mb-4">
                                        <div class="d-flex flex-column justify-content-between align-items-center mb-2">
                                            <div class=" d-flex flex-column ">
                                                <div class="d-flex align-content-center justify-content-between">
                                                    <div class="text-center w-100">
                                                        <label for="adults" class="fw-bold">Adults</label>
                                                        <p class="text-muted small mb-0">Age 13+</p>
                                                    </div>
                                                    <div class="controls d-flex align-items-center">
                                                        <button type="button" onclick="decrement('adults')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">-</button>
                                                        <input type="number" id="adults" name="adults" value="1" min="0"
                                                            class="form-control mx-2 text-center" style="width: 50px;">
                                                        <button type="button" onclick="increment('adults')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" d-flex flex-column ">

                                                <div class="d-flex  align-content-center justify-content-between">
                                                    <div class="text-center w-100">
                                                        <label for="children" class="fw-bold">child</label>
                                                        <p class="text-muted small mb-0">Age 2+</p>
                                                    </div>
                                                    <div class="controls d-flex align-items-center">
                                                        <button type="button" onclick="decrement('children')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">-</button>
                                                        <input type="number" id="children" name="children" value="1" min="0"
                                                            class="form-control mx-2 text-center" style="width: 50px;">
                                                        <button type="button" onclick="increment('children')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">+</button>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class=" d-flex flex-column ">
                                                <div class="d-flex align-content-center justify-content-between">
                                                    <div class="text-center ">
                                                        <label for="pets" class="fw-bold">Pets</label>
                                                    </div>
                                                    <div class="controls d-flex align-items-center">
                                                        <button type="button" onclick="decrement('pets')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">-</button>
                                                        <input type="number" id="pets" name="pets" value="0" min="0"
                                                            class="form-control mx-2 text-center" style="width: 50px;">
                                                        <button type="button" onclick="increment('pets')"
                                                            class="btn btn-outline-secondary rounded-circle"
                                                            style="width: 30px; height: 30px; padding: 0;">+</button>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label for="pets">Pets Bringing a service animal?</label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>





                                <div class="guest-limit-info">
                                    <p>This place has a maximum of 4 guests, not including infants. If you're bringing more
                                        than
                                        2 pets, please let your Host know.</p>
                                </div>


                            </div>

                            <div class="form-group">
                                <div class="d-flex flex-column">
                                    <div class="lable d-flex justify-content-evenly">
                                        <div class="text-center w-100"> <label for="Departure">Departure</label></div>
                                        <div class="text-center w-100"> <label for="Arrival">Arrival</label></div>
                                    </div>
                                    <div class="d-flex fields">
                                        <select class="form-control text-center " id="Departure" name="Departure">
                                            <option value="">Departure</option>
                                            @foreach ($ports as $port )
                                            
                                            <option value="{{ $port->id }}">{{ $port->Name }}</option>
                                            @endforeach

                                        </select>

                                        <select class="form-control text-center " id="Arrival" name="Arrival">
                                            <option value="">Arrival</option>
                                            @foreach ($ports as $port )
                                            
                                            <option value="{{ $port->id }}">{{ $port->Name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="d-flex flex-column">
                                    <div class="lables d-flex justify-content-evenly">
                                        <div class="text-center w-100">
                                            <label for="checkin-date">Check-in Date:</label>
                                        </div>
                                        <div class="text-center w-100">
                                            <label for="checkout-date">Check-out Date:</label>
                                        </div>
                                    </div>
                                    <div class="d-flex fields">
                                        <input autocomplete="off" type="#" placeholder="dd/mm/yyyy " name="from"
                                            class="text-center form-control" id="from">
                                        <input autocomplete="off" type="#" placeholder="dd/mm/yyyy " name="to"
                                            class="text-center form-control" id="to">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-flex flex-column">
                                    <div class="lable d-flex justify-content-evenly">
                                        <div class="text-center w-100"> <label for="checkin-time">Check-in Time:</label></div>
                                        <div class="text-center w-100"> <label for="checkout-time">Check-out Time:</label></div>
                                    </div>
                                    <div class="d-flex fields">
                                        <select class="form-control text-center " id="checkin-time" name="checkin_time">
                                            <option value="">select-time</option>

                                        </select>

                                        <select class="form-control text-center " id="checkout-time" name="checkout_time">
                                            <option value="">select-time</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="explore-btn">Make Booking</button>
                            <!-- <a style="color:#d4af37;" id="addtocart" href="">OR ADD to cart to buy multiple services at time! </a> -->
                        </div>
                    </div>
                </form>
            @endif
        </div>
        <div class="col-xl-6 align-content-center justify-content-center">
            <div class="">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <img src="{{ asset($services->banner_photo) }}" alt="{{ $services->name }}"
                                class="img-thumbnail"
                                style="width: 100px; height: 100px; object-fit: cover; margin-right: 15px;">
                            <div>
                                <div class="card-text d-flex flex-column">
                                    <h5 class="card-title">{{ $services->name }}</h5>
                                    <p class="card-text">{{ $services->types->name }}</p>
                                    <p class="card-text">
                                        <span class="text-muted">{{ $services->agency->city->name }},
                                            {{ $services->agency->state->name }},
                                            {{ $services->agency->country->name }}</span>
                                    </p>
                                    <p class="card-text">
                                        <span class="text-warning">★ reviews</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @php
                       
                    $info = [];
                    foreach ($stay->attributesToArray() as $key => $value) {
                        if (!in_array($key, ['service_id', 'agency_id', 'category_id', 'type_id', 'name', 'created_at', 'updated_at', 'id','service_images'])) {
                            $info[$key] = $value;
                        }
                    }
                   
                        @endphp
                        <div class="d-flex flex-column justify-content-between">
                            @foreach($info as $key => $value)
                                <p class="mb-0">{{ ucfirst($key) }}:<strong> {{ $value }}</strong></p>
                            @endforeach
                        </div>
                        

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
        integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>

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
    @elseif($services->category_id == 3)
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
    @elseif($services->category_id == 4)
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