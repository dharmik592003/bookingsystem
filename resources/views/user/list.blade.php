@extends('layout.layout')
@section('main')
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
    @if(Session::get('loginid') == 1)
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <!--begin::Col-->

                    <div class="col-lg-12 col-6">
                        <!--begin::Small Box Widget 2-->



                        <!--end::Col-->
                        <div class="col-lg-12 col-6">
                            <!--begin::Small Box Widget 2-->
                            <div class="small-box text-bg-success">
                                <div class="inner">
                                    <h3>{{ $usercount }}</h3>
                                    <p>total users</p>
                                </div>
                                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path
                                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                    </path>
                                </svg>

                                <button type="button" class="btn btn-success" id="adduser" data-bs-toggle="modal"
                                    data-bs-target="#myModal">
                                    add users
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
                                    <th scope="col">email</th>

                                    <th scope="col">actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $loop->index + 1  }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>

                                            <a href="{{ Route('customer.edit', $customer->id) }}"
                                                class="btn btn-success">edit</a><a class="btn btn-danger"
                                                href="{{ Route('customer.delete', $customer->id) }}">delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else()
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <!--begin::Col-->

                    <div class="col-lg-12 col-6">
                        <!--begin::Small Box Widget 2-->



                        <!--end::Col-->
                        <div class="col-lg-12 col-6">
                            <!--begin::Small Box Widget 2-->
                            <div class="small-box text-bg-success">
                                <div class="inner">
                                    <h3>{{ $usercount }}</h3>
                                    <p>total users</p>
                                </div>
                                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path
                                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                    </path>
                                </svg>

                                <button type="button" class="btn btn-success" id="adduser" data-bs-toggle="modal"
                                    data-bs-target="#myModal">
                                    add users
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
                                    <th scope="col">email</th>

                                    <th scope="col">actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $loop->index + 1  }}</td>
                                        <td>{{ $customer->customer->name }}</td>
                                        <td>{{ $customer->customer->email }}</td>
                                        <td>
                                            @can('Customer_list Edit')
                                                <a href="{{ Route('customer.edit', $customer->customer->id) }}" class="btn btn-success">edit</a>
                                            @endcan
                                            @can('Customer_list Delete')
                                                <a class="btn btn-danger"
                                                    href="{{ Route('customer.delete', $customer->customer->id) }}">delete</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
                        <div id='contant'>
                            <form action="/{{ route('customer.store') }}" method="post">
                                @csrf
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                        <input type="text" name="name" id="form3Example1c" class="form-control" />
                                        <label class="form-label" for="form3Example1c">Your Name</label>
                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                        <input type="email" name="email" id="form3Example3c" class="form-control" />
                                        <label class="form-label" for="form3Example3c">Your Email</label>
                                    </div>
                                    <input class="role form-check-input" type="radio" name="role" id="customer" value="2"
                                        checked Hidden>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                        <input type="password" name="password" id="form3Example4c" class="form-control" />
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
                                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                                    <label class="form-check-label" for="form2Example3">
                                        I agree all statements in
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
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
@endsection


<!-- ChartJS -->