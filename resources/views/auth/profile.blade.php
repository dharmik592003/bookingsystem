@extends('layout.layout')

@section('main')
<div class="container mt-5">
    <div class="row">
        <!-- Profile Section -->
        <div class="col-md-4 d-flex flex-column align-items-center">
            <div class="card shadow border-0 text-center">
                <div class="card-body">
                    <div class="profile-circle mb-3">
                        <!-- Placeholder for profile image -->
                        <div class="profile-icon" style="width: 200px; height: 200px;  border-radius: 100% !important; overflow: hidden !important; ">
                            <img src="{{ $user->profile_photo ? asset($user->profile_photo) : asset('admin/dist/assets/img/user.webp') }}" class="img-fluid" alt="User Image" />
                      
                        </div>
                    </div>
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal">Edit profile</button>
                </div>
            </div>
        </div>

        <!-- User Details Section -->
        <div class="col-md-8">
            <h4 class="mb-4">User Details</h4>
            <ul class="list-unstyled">
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Phone:</strong> {{ $user->number }}</li>
                <li><strong>address:</strong> {{ $user->address }}</li>
                @if($user->role == 3)
                    <li><strong>Agency Name:</strong> {{ $user->agencytypeuser->name }}</li>
                    <li><strong>State:</strong> {{ $user->state->name ?? 'N/A' }}</li>
                    <li><strong>City:</strong> {{ $user->city->name ?? 'N/A' }}</li>
                @endif
            </ul>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/updateuser/{{ $user->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="name" value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">profile photo</label>
                            <input type="file" class="form-control" id="fullname" name="profile_photo"   required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->number }}" required maxlength="11">
                        </div>
                        @if($user->role == 3 && $user->agency)
                            <div class="mb-3">
                                <label for="agencyName" class="form-label">Agency Name</label>
                                <input type="text" class="form-control" id="agencyName" name="agencyname" value="{{ $user->agency->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="state" class="form-label">State</label>
                                <select name="state_id" class="form-select" id="state">
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}" {{ $user->agency->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <select name="city_id" class="form-select" id="city">
                                    <option value="">Select City</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" {{ $user->agency->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
