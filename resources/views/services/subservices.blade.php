@extends('layout.layout')
@section('style')
    <link rel="stylesheet" href="{{asset('admin/dist/css/apexcharts.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/dist/css/jsvectormap.min.css')}}" />
@endsection

@section('main')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Dashboard</h3>
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
                                <h3></h3>
                                <p>Total services</p>
                            </div>
                            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path
                                    d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z">
                                </path>
                            </svg>
                            <a href='/addserviceagency' id="addservices" class="btn btn-primary">
                                add service</a>
                        </div>
                        <!--end::Small Box Widget 2-->
                    </div>
                    <!--end::Col-->
                </div>
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($services as $service)
                            <div class="col-xl-3">
                                <div class="card">
                                    <div class="img" style="width: 100%;">
                                        <img src="{{ asset($service->photo) }}" class="img-fluid card-img" alt="">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $service->name }}</h5>
                                        <p class="card-text">{{ $service->desc }}</p>
                                        <a href="{{ $service->name }}/service" class="btn btn-primary">Check out</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </main>
@endsection
@include('components.footer')
@section('script')
    <!-- apexcharts -->
    <script src="{{asset('admin/dist/js/apexcharts.min.js')}}"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous">
        </script>
    <script src="{{asset('admin/dist/js/jsvectormap.min.js')}}"></script>
    <script src="{{asset('admin/dist/js/world.js')}}"></script>
@endsection