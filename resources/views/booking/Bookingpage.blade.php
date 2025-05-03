@extends('layout.layout')
@dd(Session::all())
@section('style')

<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="Stylesheet"
type="text/css"/>
@endsection

<!--end::Head-->
<!--begin::Body-->

@section('main')

<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
        
                    <h3 class="mb-0">Available services</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->

                <!--end::Col-->
                <div class="col-lg-12 col-6">
                    <!--begin::Small Box Widget 2-->
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3>book your services</h3>
                            <p></p>
                            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path
                                    d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z">
                                </path>
                            </svg>
                        </div>


                    </div>
                    <!--end::Small Box Widget 2-->
                </div>
                <!--end::Col-->


            </div>


            <section class="container">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ asset($service->photo) }}" alt="Card image cap">
                            <div class="card-body">
                                <div class="card-text d-flex flex-column">
                                    <div class="card-title">
                                        <h5 class="card-title">{{ $service->name }}</h5>
                                    </div>
                                    <div class="card-details">
                                        <p class="card-text">{{$service->desc}}</p>
                                        <p class="card-text">{{$service->price}}</p>
                                        <p class="card-text">agency: {{$service->agency->name}}</p>
                                    </div>
                                </div>
                                <a href="#" id="addtocart" class="btn btn-primary">add to cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-pull-7">

                        <form method="post" action="/{{$service->id}}/book">
                            @csrf
                            <div class="form-group">
                                <span class="form-label">Service</span>
                                <input class="form-control" value="{{ $service->name }}" type="text">
                            </div>
                            <div class="form-group">
                                <span class="form-label">Price</span>
                                <input class="form-control" value="{{ $service->price }}" type="text">
                            </div>
                            <div class="form-group">
                                <span class="form-label">agency</span>
                                <input class="form-control" value="{{$service->agency->name}}" type="text">
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <span class="form-label">Check In</span>
                                        <input class="form-control date" name="from" type="text" required=""
                                            id="from" disabled-dates="2025-2-25" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <span class="form-label">Check out</span>
                                        <input class="form-control date" name="to" type="text" id="to"
                                            required="" autocomplete="off">
                                    </div>
                                </div>

                           <div class="col-sm-4">
                                        <input type="radio" class="btn-check" name="time[]" id="option1"
                                            autocomplete="off" value="9Am-12PM">
                                        <label class="btn btn-secondary" for="option1">9Am-12PM</label>

                                        <input type="radio" class="btn-check" value="12PM-3PM" name="time[]"
                                            id="option2" autocomplete="off">
                                        <label class="btn btn-secondary" for="option2">12PM-3PM</label>

                                        <input type="radio" class="btn-check" value="3PM-8PM" name="time[]"
                                            id="option3" autocomplete="off">
                                        <label class="btn btn-secondary" for="option3">3PM-8PM</label>

                                        <input type="radio" class="btn-check" value="8PM-12AM" name="time[]"
                                            id="option4" autocomplete="off">
                                        <label class="btn btn-secondary" for="option4">8PM-12AM</label>
                                    </div> 

                                <div class="col-xl-4">
                                            <div class="time-picker" data-coreui-locale="en-US"
                                                data-coreui-toggle="time-picker" id="timePicker1"></div>
                                            <div class="time-picker" data-coreui-locale="en-US"
                                                data-coreui-time="02:17:35 PM" data-coreui-toggle="time-picker"
                                                id="timePicker2"></div>
                                    </div>


                            </div>
                            <div class="form-btn">
                                <button type="submit" class="btn btn-primary">book now</button>
                            </div>
                        </form>

                    </div>
                </div>
            </section>
        </div>

        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="mb-3" id="mainform">
                            <div id="contant">

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>



                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
</main>
@endsection

@section('script')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            jQuery.browser = {};
            (function () {
                jQuery.browser.msie = false;
                jQuery.browser.version = 0;
                if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
                    jQuery.browser.msie = true;
                    jQuery.browser.version = RegExp.$1;
                }
            })();
            const mindates = [];
            const maxdates = [];
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "get",
                url: "/" + {{$service->id}} + "/availability",
                success: function (data) {
                    if (data.length != 0) {
                        for (let i = 0; i < (data.date).length; i++) {
                            console.log(data.date[i].from);
                            mindates.push(data.date[i].from);
                            maxdates.push(data.date[i].to);
                        }
                        console.log(maxdates)
                        console.log(mindates)
                        function noSundaysOrHolidays(date) {
                            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                            return [mindates.indexOf(string) == -1 && maxdates.indexOf(string) == -1]
                        }

                        $("#from").datepicker({
                            dateFormat: 'yy-mm-dd',
                            multidate: true,
                            beforeShowDay: function (date) {
                                $thisDate = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
                                var day = date.getDay();
                                if ($.inArray($thisDate, mindates) == -1 && day != 5 && day != 6) {
                                    return [true, ""];
                                } else {
                                    return [false, "", "Unavailable"];
                                }
                            }
                            // beforeShowDay: noSundaysOrHolidays,

                        });
                        $("#to").datepicker({
                            dateFormat: 'yy-mm-dd',
                            multidate: true,
                            beforeShowDay: function (date) {
                                $thisDate = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
                                var day = date.getDay();
                                if ($.inArray($thisDate, maxdates) == -1 && day != 5 && day != 6) {
                                    return [true, ""];
                                } else {
                                    return [false, "", "Unavailable"];
                                }
                            }
                            // beforeShowDay: noSundaysOrHolidays,
                        });
                    }
                    else {
                        $("#from").datepicker({
                            dateFormat: 'yy-mm-dd',
                            minDate:0
                        }) ;
                        $("#to").datepicker({
                            dateFormat: 'yy-mm-dd',
                        });
                        $('#from').change(function () {
                            startDate = $(this).datepicker('getDate');
                            $("#to").datepicker("option", "minDate", startDate);
                        })
                        $('#to').change(function () {
                            endDate = $(this).datepicker('getDate');
                            $("#from").datepicker("option", "maxDate", endDate);
                        })
                    }

                }
            });
        });
    </script>
  
  @endsection