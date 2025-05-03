@extends('layout.layout')
@section('style')
<style>
    .owl-item .active{
width: 100% !important;
    }
</style>
@endsection
@section('main')
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
                                    <img src="{{ asset($service->banner_photo) }}" class="img-fluid card-img" alt="">
                                </div>
                                <div class="card-body">
                                    <div>
                                    <h5 class="card-title">{{ $service->name }}</h5>
                                    </div>
                                    <div>
                                    <p class="card-text">{{ $service->desc }}</p></div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <a href="services/{{ $service->category->name }}/{{ $service->name }}"
                                            class="btn btn-success">Check
                                            out</a>
                                        <a href='{{ route('edit_agency_service',$service->id) }}'
                                            class="btn btn-primary">edit</a>
                                        <a href='{{ route('delete_agency_service',$service->id) }}'
                                            class="btn btn-danger delete-service">delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection
@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteLinks = document.querySelectorAll('.delete-service');
    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this service?')) {
                return;
            }
            const url = this.href;
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({}),
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    alert('Failed to delete the service.');
                }
            })
            .catch(error => {
                alert('Error occurred: ' + error);
            });
        });
    });
});
</script>
@endsection
