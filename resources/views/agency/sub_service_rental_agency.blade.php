@extends('layout.layout')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">


    <style>
        .owl-carousel {
            display: block !important;
        }

        .service-listing {
            margin: 20px 0;
        }

        .service-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .service-image-carousel .item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        .service-card-body {
            margin-top: 10px;
        }

        .service-card-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .service-card-desc {
            font-size: 14px;
            color: #555;
            margin-bottom: 12px;
        }

        .service-card-actions {
            display: flex;
            justify-content: space-between;
        }

        .availability-status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
        }

        .available {
            background-color: #28a745;
        }

        .not-available {
            background-color: #dc3545;
        }
    </style>
@endsection

@section('main')

    <div class="container">
        <div class="create-button-container" style="margin-bottom: 20px; text-align: right;">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createServiceModal">
                Create New Service
            </button>
        </div>
        <div class="service_list">
            <h2 class="my-4">Services Listing</h2>
            <div class="row service-listing">
              
                @if($allServices)
                
                        @foreach ($allServices as $service)
                        
                                <div class="col-md-4">
                                    <div class="service-card">
                                        @php
                                            $images = json_decode($service->service_images, true);
                                        @endphp
                                        <div class="owl-carousel owl-theme service-image-carousel">
                                            @if(!empty($images) && count($images) > 0)
                                                @foreach($images as $image)
                                                    <div class="item">
                                                        <img src="{{ asset($image) }}" alt="{{ $service->name }}">
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="item">
                                                    <img src="{{ asset($service->banner_photo) }}" alt="{{ $service->name }}">
                                                </div>
                                            @endif
                                        </div>
                                        @if($service->category_id == 1)
                                        <div class="service-card-body d-flex  flex-column mt-2">
                                            <div class="service-card-title">{{ $service->Name }}</div>
                                            <div class="service-card-desc">
                                                <ul class="service-details">

                                                    <li><strong>Beds:</strong> {{ $service->beds }}</li>
                                                    <li><strong>Baths:</strong> {{ $service->baths }}</li>
                                                    <li><strong>Guests:</strong> {{ $service->guests }}</li>
                                                    <li><strong>Amenities:</strong> {{ $service->amenities }}</li>
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="service-card-actions mt-3">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editServiceModal{{ $service->id }}">
                                                Edit
                                            </button>

                                            <!-- Edit Modal -->
                                            <form action="{{ route('stays.destroy', $service->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this service?');"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#serviceDetailsModal{{ $service->id }}">
                                                View Details
                                            </button>
                                            @elseif ($service->category_id == 2)
                                                <div class="service-card-body d-flex  flex-column mt-2">
                                                    <div class="service-card-title">{{ $service->Name }}</div>
                                                    <div class="service-card-desc">
                                                        <ul class="service-details">

                                                            <li><strong>Seats:</strong> {{ $service->seats }}</li>
                                                            <li><strong>Fuel Type:</strong> {{ $service->fuel_type }}</li>
                                                            <li><strong>Transmission:</strong> {{ $service->transmission }}</li>
                                                            <li><strong>Doors:</strong> {{ $service->doors }}</li>
                                                        </ul>
                                                    </div>

                                                </div>
                                                <div class="service-card-actions mt-3">
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#editServiceModal{{ $service->id }}">
                                                        Edit
                                                    </button>

                                                    <!-- Edit Modal -->
                                                    <form action="{{ route('cars.destroy', $service->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this service?');"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#serviceDetailsModal{{ $service->id }}">
                                                        View Details
                                                    </button>
                                                @elseif($service->category_id == 3)
                                                    <div class="service-card-body d-flex  flex-column mt-2">
                                                        <div class="service-card-title">{{ $service->Name }}</div>
                                                        <div class="service-card-desc">
                                                            <ul class="service-details">

                                                                <li><strong>Length:</strong> {{ $service->length }}</li>
                                                                <li><strong>Cabins:</strong> {{ $service->cabins }}</li>
                                                                <li><strong>Guests:</strong> {{ $service->guests }}</li>
                                                                <li><strong>Amenities:</strong> {{ $service->amenities }}</li>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                    <div class="service-card-actions mt-3">
                                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#editServiceModal{{ $service->id }}">
                                                            Edit
                                                        </button>

                                                        <!-- Edit Modal -->
                                                        <form action="{{ route('yacht.destroy', $service->id) }}" method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this service?');"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#serviceDetailsModal{{ $service->id }}">
                                                            View Details
                                                        </button>
                                      @elseif($service->category_id == 4)
                                      <div class="service-card-body d-flex  flex-column mt-2">
                                                        <div class="service-card-title">{{ $service->Name }}</div>
                                                        <div class="service-card-desc">
                                                            <ul class="service-details">

                                                                <li><strong>Length:</strong> {{ $service->length }}</li>
                                                                <li><strong>Cabins:</strong> {{ $service->cabins }}</li>
                                                                <li><strong>Guests:</strong> {{ $service->guests }}</li>
                                                                <li><strong>Amenities:</strong> {{ $service->amenities }}</li>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                    <div class="service-card-actions mt-3">
                                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#editServiceModal{{ $service->id }}">
                                                            Edit
                                                        </button>

                                                        <!-- Edit Modal -->
                                                        <form action="{{ route('charter.destroy', $service->id) }}" method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this service?');"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#serviceDetailsModal{{ $service->id }}">
                                                            View Details
                                                        </button>
                                                        @endif
                                            @if ($categoryName == 'Cars')
                                                <div class="modal fade" id="editServiceModal{{ $service->id }}" tabindex="-1"
                                                    aria-labelledby="editServiceModalLabel{{ $service->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form method="POST" action="{{ route('cars.update', $service->id) }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editServiceModalLabel{{ $service->id }}">Edit
                                                                        Service</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="serviceName{{ $service->id }}"
                                                                            class="form-label">Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="serviceName{{ $service->id }}" name="name"
                                                                            value="{{ $service->name }}" required>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="seats{{ $service->id }}" class="form-label">Seats</label>
                                                                        <input type="number" class="form-control" id="seats{{ $service->id }}"
                                                                            name="seats" value="{{ $service->seats }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="fuelType{{ $service->id }}" class="form-label">Fuel
                                                                            Type</label>
                                                                        <input type="text" class="form-control" id="fuelType{{ $service->id }}"
                                                                            name="fuel_type" value="{{ $service->fuel_type }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="transmission{{ $service->id }}"
                                                                            class="form-label">Transmission</label>
                                                                        <input type="text" class="form-control"
                                                                            id="transmission{{ $service->id }}" name="transmission"
                                                                            value="{{ $service->transmission }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="doors{{ $service->id }}" class="form-label">Doors</label>
                                                                        <input type="number" class="form-control" id="doors{{ $service->id }}"
                                                                            name="doors" value="{{ $service->doors }}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="serviceImages{{ $service->id }}" class="form-label">Service
                                                                            Images</label>
                                                                        <input type="file" name="service_images[]"
                                                                            id="serviceImages{{ $service->id }}" multiple>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="serviceDetailsModal{{ $service->id }}" tabindex="-1"
                                                    aria-labelledby="serviceDetailsModalLabel{{ $service->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="serviceDetailsModalLabel{{ $service->id }}">
                                                                    {{ $service->name }} Details
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><strong>Name:</strong> {{ $service->name }}</p>
                                                                <p><strong>Seats:</strong> {{ $service->seats ?? 'N/A' }}</p>
                                                                <p><strong>Fuel Type:</strong> {{ $service->fuel_type ?? 'N/A' }}</p>
                                                                <p><strong>Transmission:</strong> {{ $service->transmission ?? 'N/A' }}</p>
                                                                <p><strong>Doors:</strong> {{ $service->doors ?? 'N/A' }}</p>
                                                                <p><strong>Availability:</strong>
                                                                    {{ $service->is_available ? 'Available' : 'Available' }}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @elseif ($categoryName == 'stays')
                                                <div class="modal fade" id="editServiceModal{{ $service->id }}" tabindex="-1"
                                                    aria-labelledby="editServiceModalLabel{{ $service->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form method="POST" action="{{ route('cars.update', $service->id) }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editServiceModalLabel{{ $service->id }}">Edit
                                                                        Service</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="serviceName{{ $service->id }}"
                                                                            class="form-label">Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="serviceName{{ $service->id }}" name="name"
                                                                            value="{{ $service->name }}" required>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="beds{{ $service->id }}" class="form-label">Beds</label>
                                                                        <input type="number" class="form-control" id="beds{{ $service->id }}"
                                                                            name="beds" value="{{ $service->beds }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="baths{{ $service->id }}" class="form-label">Baths</label>
                                                                        <input type="number" class="form-control" id="baths{{ $service->id }}"
                                                                            name="baths" value="{{ $service->baths }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="guests{{ $service->id }}" class="form-label">Guests</label>
                                                                        <input type="number" class="form-control" id="guests{{ $service->id }}"
                                                                            name="guests" value="{{ $service->guests }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="amenities{{ $service->id }}"
                                                                            class="form-label">Amenities</label>
                                                                        <textarea class="form-control" id="amenities{{ $service->id }}"
                                                                            name="amenities" rows="3">{{ $service->amenities }}</textarea>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="amenities{{ $service->id }}"
                                                                            class="form-label">Discount</label>
                                                                            <input type="number" class="form-control" id="Discount{{ $service->id }}"
                                                                            name="Discount" rows="3">{{ $service->Discount }}
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="serviceImages{{ $service->id }}" class="form-label">Service
                                                                            Images</label>
                                                                        <input type="file" name="service_images[]"
                                                                            id="serviceImages{{ $service->id }}" multiple>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="serviceDetailsModal{{ $service->id }}" tabindex="-1"
                                                    aria-labelledby="serviceDetailsModalLabel{{ $service->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="serviceDetailsModalLabel{{ $service->id }}">
                                                                    {{ $service->name }} Details
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><strong>Name:</strong> {{ $service->name }}</p>
                                                                <p><strong>Beds:</strong> {{ $service->beds ?? 'N/A' }}</p>
                                                                <p><strong>Baths:</strong> {{ $service->baths ?? 'N/A' }}</p>
                                                                <p><strong>Guests:</strong> {{ $service->guests ?? 'N/A' }}</p>
                                                                <p><strong>Amenities:</strong> {{ $service->amenities ?? 'N/A' }}</p>
                                                                <p><strong>Discount:</strong> {{ $service->Discount ?? 'O' }}</p>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @elseif ($categoryName == 'Yachts')
                                                <div class="modal fade" id="editServiceModal{{ $service->id }}" tabindex="-1"
                                                    aria-labelledby="editServiceModalLabel{{ $service->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form method="POST" action="{{ route('cars.update', $service->id) }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editServiceModalLabel{{ $service->id }}">Edit
                                                                        Service</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="serviceName{{ $service->id }}"
                                                                            class="form-label">Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="serviceName{{ $service->id }}" name="name"
                                                                            value="{{ $service->name }}" required>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="length{{ $service->id }}" class="form-label">Length</label>
                                                                        <input type="number" class="form-control" id="length{{ $service->id }}"
                                                                            name="length" value="{{ $service->length }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="cabins{{ $service->id }}" class="form-label">Cabins</label>
                                                                        <input type="number" class="form-control" id="cabins{{ $service->id }}"
                                                                            name="cabins" value="{{ $service->cabins }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="guests{{ $service->id }}" class="form-label">Guests</label>
                                                                        <input type="number" class="form-control" id="guests{{ $service->id }}"
                                                                            name="guests" value="{{ $service->guests }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="amenities{{ $service->id }}"
                                                                            class="form-label">Amenities</label>
                                                                        <textarea class="form-control" id="amenities{{ $service->id }}"
                                                                            name="amenities" rows="3">{{ $service->amenities }}</textarea>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="amenities{{ $service->id }}"
                                                                            class="form-label">Discount</label>
                                                                        <input type="number" class="form-control" id="Discount{{ $service->id }}"
                                                                            name="Discount" rows="3">{{ $service->Discount }}
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="serviceImages{{ $service->id }}" class="form-label">Service
                                                                            Images</label>
                                                                        <input type="file" name="service_images[]"
                                                                            id="serviceImages{{ $service->id }}" multiple>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="serviceDetailsModal{{ $service->id }}" tabindex="-1"
                                                    aria-labelledby="serviceDetailsModalLabel{{ $service->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="serviceDetailsModalLabel{{ $service->id }}">
                                                                    {{ $service->name }} Details
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><strong>Name:</strong> {{ $service->name }}</p>
                                                                <p><strong>Length:</strong> {{ $service->length ?? 'N/A' }} ft</p>
                                                                <p><strong>Cabins:</strong> {{ $service->cabins ?? 'N/A' }}</p>
                                                                <p><strong>Guests:</strong> {{ $service->guests ?? 'N/A' }}</p>
                                                                <p><strong>Amenities:</strong> {{ $service->amenities ?? 'N/A' }}</p>
                                                                <p><strong>Discount:</strong> {{ $service->Discount ?? 'N/A' }}</p>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @elseif ($categoryName == 'Charters')
                                                <div class="modal fade" id="editServiceModal{{ $service->id }}" tabindex="-1"
                                                    aria-labelledby="editServiceModalLabel{{ $service->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form method="POST" action="{{ route('cars.update', $service->id) }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editServiceModalLabel{{ $service->id }}">Edit
                                                                        Service</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="name{{ $service->id }}" class="form-label">Name</label>
                                                                        <input type="text" class="form-control" id="name{{ $service->id }}"
                                                                            name="name" value="{{ $service->name }}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="duration{{ $service->id }}" class="form-label">Duration
                                                                            (Hours)</label>
                                                                        <input type="number" class="form-control"
                                                                            id="duration{{ $service->id }}" name="duration_hours"
                                                                            value="{{ $service->duration_hours }}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="capacity{{ $service->id }}"
                                                                            class="form-label">Capacity</label>
                                                                        <input type="number" class="form-control"
                                                                            id="capacity{{ $service->id }}" name="capacity"
                                                                            value="{{ $service->capacity }}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="amenities{{ $service->id }}"
                                                                            class="form-label">Amenities</label>
                                                                        <textarea class="form-control" id="amenities{{ $service->id }}"
                                                                            name="amenities" rows="3">{{ $service->amenities }}</textarea>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="discount{{ $service->id }}"
                                                                            class="form-label">Discount</label>
                                                                        <input type="number" class="form-control" id="discount{{ $service->id }}"
                                                                            name="Discount" value="{{ $service->Discount }}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="serviceImages{{ $service->id }}" class="form-label">Service
                                                                            Images</label>
                                                                        <input type="file" name="service_images[]"
                                                                            id="serviceImages{{ $service->id }}" multiple>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="serviceDetailsModal{{ $service->id }}" tabindex="-1"
                                                    aria-labelledby="serviceDetailsModalLabel{{ $service->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="serviceDetailsModalLabel{{ $service->id }}">
                                                                    {{ $service->name }} Details
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><strong>Name:</strong> {{ $service->name ?? 'N/A' }}</p>
                                                                <p><strong>Duration (Hours):</strong> {{ $service->duration_hours ?? 'N/A' }}
                                                                </p>
                                                                <p><strong>Capacity:</strong> {{ $service->capacity ?? 'N/A' }}</p>
                                                                <p><strong>Amenities:</strong> {{ $service->amenities ?? 'N/A' }}</p>
                                                                <p><strong>Discount:</strong> {{ $service->discount ?? 'N/A' }}</p>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                        @endforeach
                
                        @elseif(blank($allServices))
                    <div class="col-12 text-center">Create service first</div>
                @endif
            </div>
        </div>

    </div>


    @if($categoryName == 'stays')
        <div class="modal fade" id="createServiceModal" tabindex="-1" aria-labelledby="createServiceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('stays.store', [
                'service_id' =>
                    $info['service_id'],
                'category_id' => $info['category_id'],
                'type_id' => $info['type_id'],
                'agency_id' => $info['agency_id']
            ]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createServiceModalLabel">Create New Service</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="serviceName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="serviceName" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="beds" class="form-label">Beds</label>
                                <input type="number" class="form-control" id="beds" name="beds">
                            </div>
                            <div class="mb-3">
                                <label for="baths" class="form-label">Baths</label>
                                <input type="number" class="form-control" id="baths" name="baths">
                            </div>
                            <div class="mb-3">
                                <label for="guests" class="form-label">Guests</label>
                                <input type="number" class="form-control" id="guests" name="guests">
                            </div>
                            <div class="mb-3">
                                <label for="amenities" class="form-label">Amenities</label>
                                <textarea class="form-control" id="amenities" name="amenities" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="discount" class="form-label">Discount</label>
                                <input type="number" class="form-control" id="Discount" name="Discount" value="0" />
                            </div>

                            <div class="mb-3">
                                <label for="serviceImages" class="form-label">Service Images</label>
                                <input type="file" name="service_images[]" id="" multiple>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Service</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @elseif($categoryName == 'Cars')
        <div class="modal fade" id="createServiceModal" tabindex="-1" aria-labelledby="createServiceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('cars.store', [
                'service_id' =>
                    $info['service_id'],
                'category_id' => $info['category_id'],
                'type_id' => $info['type_id'],
                'agency_id' => $info['agency_id']
            ]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createServiceModalLabel">Create New Service</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="serviceName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="serviceName" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="seats" class="form-label">Seats</label>
                                <input type="number" class="form-control" id="seats" name="seats">
                            </div>
                            <div class="mb-3">
                                <label for="fuelType" class="form-label">Fuel Type</label>
                                <input type="text" class="form-control" id="fuelType" name="fuel_type">
                            </div>
                            <div class="mb-3">
                                <label for="transmission" class="form-label">Transmission</label>
                                <input type="text" class="form-control" id="transmission" name="transmission">
                            </div>
                            <div class="mb-3">
                                <label for="doors" class="form-label">Doors</label>
                                <input type="number" class="form-control" id="doors" name="doors">
                            </div>
                            <div class="mb-3">
                                <label for="discount" class="form-label">Discount</label>
                                <input type="number" class="form-control" id="Discount" name="Discount" value="0" />
                            </div>
                            <div class="mb-3">
                                <label for="serviceImages" class="form-label">Service Images</label>
                                <input type="file" name="service_images[]" id="" multiple>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Service</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    @elseif($categoryName == 'Charter')
        <div class="modal fade" id="createServiceModal" tabindex="-1" aria-labelledby="createServiceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('charters.store', [
                'service_id' =>
                    $info['service_id'],
                'category_id' => $info['category_id'],
                'type_id' => $info['type_id'],
                'agency_id' => $info['agency_id']
            ]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createServiceModalLabel">Create New Charter</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="serviceName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="serviceName" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="durationHours" class="form-label">Duration (Hours)</label>
                                <input type="number" class="form-control" id="durationHours" name="duration_hours" required>
                            </div>

                            <div class="mb-3">
                                <label for="capacity" class="form-label">Capacity</label>
                                <input type="number" class="form-control" id="capacity" name="capacity" required>
                            </div>

                            <div class="mb-3">
                                <label for="amenities" class="form-label">Amenities</label>
                                <textarea class="form-control" id="amenities" name="amenities" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="discount" class="form-label">Discount</label>
                                <input type="number" class="form-control" id="Discount" name="Discount" value="0" />
                            </div>
                            <div class="mb-3">
                                <label for="serviceImages" class="form-label">Service Images</label>
                                <input type="file" name="service_images[]" id="serviceImages" multiple>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Charter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    @elseif($categoryName == 'Yacht')
        <div class="modal fade" id="createServiceModal" tabindex="-1" aria-labelledby="createServiceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('yachts.store', [
                'service_id' =>
                    $info['service_id'],
                'category_id' => $info['category_id'],
                'type_id' => $info['type_id'],
                'agency_id' => $info['agency_id']
            ]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createServiceModalLabel">Create New Yacht</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="serviceName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="serviceName" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="length" class="form-label">Length</label>
                                <input type="number" class="form-control" id="length" name="length" required>
                            </div>

                            <div class="mb-3">
                                <label for="cabins" class="form-label">Cabins</label>
                                <input type="number" class="form-control" id="cabins" name="cabins" required>
                            </div>

                            <div class="mb-3">
                                <label for="guests" class="form-label">Guests</label>
                                <input type="number" class="form-control" id="guests" name="guests" required>
                            </div>

                            <div class="mb-3">
                                <label for="amenities" class="form-label">Amenities</label>
                                <textarea class="form-control" id="amenities" name="amenities" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="discount" class="form-label">Discount</label>
                                <input type="number" class="form-control" id="Discount" name="Discount" value="0" />
                            </div>
                            <div class="mb-3">
                                <label for="serviceImages" class="form-label">Service Images</label>
                                <input type="file" name="service_images[]" id="serviceImages" multiple>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Yacht</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>




    @endif
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
        integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script>
        $(function () {
            // Owl Carousel for service image carousels
            $('.service-image-carousel').owlCarousel({
                items: 1,
                dots: false,
                margin: 5,
                loop: true,
                nav: true,
                navText: ["<div class='nav-button d-flex owl-prev'>&larr; prev</div>", "<div class='nav-button d-flex owl-next'>next&rarr;</div>"]
            });

            // Existing carousel for main banner images

        });
    </script>
    <!-- Keep existing scripts for booking form and availability here -->
@endsection