@extends('layout.layout')
@section('style')
    <link rel="stylesheet" href="{{asset('admin/dist/css/apexcharts.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/dist/css/jsvectormap.min.css')}}" />
@endsection
@section('main')


    <!--end::Sidebar-->
    <!--begin::App Main-->
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
                                <h3>{{ $total }}</h3>
                                <p>Total services</p>
                            </div>
                            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path
                                    d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z">
                                </path>
                            </svg>
                            <button type="button" id="addservices" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#myModal">
                                add service
                            </button>

                        </div>
                        <!--end::Small Box Widget 2-->
                    </div>
                    <!--end::Col-->


                </div>

                <div class="row">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)


                                <tr>
                                    <th>{{ $loop->index + 1 }}</th>
                                    <td>{{ $service->name }}</td>

                                    <td>
                                        <a href="" class="btn btn-success">approve</a><a class="btn btn-danger"
                                            href="">decline</a><a class="btn btn-secondary" href="">pending</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>

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
@include('components.footer')

<!--end::App Wrapper-->
<!--begin::Script-->
@section('script')


    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- sortablejs -->
    <script src="{{asset('admin/dist/js/Sortable.min.js')}}"></script>
    <!-- sortablejs -->
    <script>
        const connectedSortables = document.querySelectorAll('.connectedSortable');
        connectedSortables.forEach((connectedSortable) => {
            let sortable = new Sortable(connectedSortable, {
                group: 'shared',
                handle: '.card-header',
            });
        });

        const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
        cardHeaders.forEach((cardHeader) => {
            cardHeader.style.cursor = 'move';
        });
    </script>
    <!-- apexcharts -->
    <script src="{{asset('admin/dist/js/apexcharts.min.js')}}"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous">
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>


        $('#adduser').click(function () {

            let userform = ` <div id='contant'>
                <form action="/saveuser" method="post">
                                       @csrf
                <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                    <input type="text" name="name" id="form3Example1c"
                                                        class="form-control" />
                                                    <label class="form-label" for="form3Example1c">Your Name</label>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                    <input type="email" name="email" id="form3Example3c"
                                                        class="form-control" />
                                                    <label class="form-label" for="form3Example3c">Your Email</label>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                    <input type="password" name="password" id="form3Example4c"
                                                        class="form-control" />
                                                    <label class="form-label" for="form3Example4c">Password</label>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                    <input type="password" id="form3Example4cd" class="form-control" />
                                                    <label class="form-label" for="form3Example4cd">Repeat your
                                                        password</label>
                                                </div>
                                            </div>

                                            <div class="form-check d-flex justify-content-center mb-5">
                                                <input class="form-check-input me-2" type="checkbox" value=""
                                                    id="form2Example3c" />
                                                <label class="form-check-label" for="form2Example3">
                                                    I agree all statements in
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                            </div>`
            $('#contant').replaceWith(userform)
        })


    </script>

    <!-- ChartJS -->

    <!-- jsvectormap -->
    <script src="{{asset('admin/dist/js/jsvectormap.min.js')}}"></script>
    <script src="{{asset('admin/dist/js/world.js')}}"></script>
    <!-- jsvectormap -->
@endsection