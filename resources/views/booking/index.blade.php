@extends('layout.layout')

@section('main')

    @if(Session::get('customer_id') == 3)
        <div class="container">
            <h2>Bookings</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr no</th>
                        <th>Service Name</th>
                        <th>Service type</th>
                        <th>check in</th>
                        <th>check out</th>
                        <th>Booking Date Time</th>

                        <th>Payment</th>
                        <th>Availablity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)

                            <tr>
                                <td>{{ $loop->index + 1}}</td>
                                <td>{{ $booking->service->name}}</td>
                                <td>{{ $booking->service->type->name}}</td>
                                <td>{{ $booking->from}}</td>
                                <td>{{ $booking->to}}</td>
                                <td>{{ $booking->created_at->format('d/m/Y')}}
                                    {{ $booking->created_at->format('h:m:s a') }}
                                </td>

                                <td>
                                    @if($booking->status == 'APPROVED')
                                        <span class="text-success">SUCCESS</span>
                                    @else
                                        <span class="text-danger">{{ $booking->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $isAvailable = $booking->status != 'APPROVED';
                                    @endphp
                                    <span class="badge {{ $isAvailable ? 'bg-success' : 'bg-danger' }} availability-badge"
                                        style="cursor:pointer;" data-booking-id="{{ $booking->id }}"
                                        data-availability="{{ $isAvailable ? 'available' : 'not_available' }}">
                                        {{ $isAvailable ? 'Available' : 'Not Available' }}
                                    </span>
                                </td>
                                <td>

                                    <a href=" {{ route('generatepdf') }}?id={{$booking->id}}" class="btn btn-primary"><i
                                            class="bi bi-download"></i></a>
                                    <button class="btn btn-warning edit" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                            class="bi bi-pencil-fill"></i></button>
                                    <a href="#" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                                </td>
                            </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    @elseif(Session::get('customer_id') == 2)
        <div class="container">
            <h2>Bookings</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr no</th>
                        <th>Service Name</th>
                        <th>Service type</th>
                        <th>Agency Name</th>
                        <th>Check in</th>
                        <th>Check out</th>
                        <th>Booking Date Time</th>
                        <th>Payment</th>

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)

                        <tr>
                            <td>{{ $loop->index + 1}}</td>
                            <td>{{ $booking->service->name}}</td>
                            <td>{{ $booking->service->types->name}}</td>
                            <td>{{ $booking->service->agency->name}}</td>
                            <td>{{ $booking->from}}</td>
                            <td>{{ $booking->to}}</td>
                            <td>{{ $booking->created_at->format('d/m/Y')}}
                                {{ $booking->created_at->format('h:m:s a') }}
                            </td>

                            <td>
                                @if($booking->status == 'APPROVED')
                                    <span class="text-success">SUCCESS</span>
                                @else
                                    <span class="text-danger">{{ $booking->status }}</span>
                                @endif
                            </td>

                            <td>
                                @if($booking->status == 'APPROVED')
                                    <a href=" {{ route('generatepdf') }}?id={{$booking->id}}" class="btn btn-primary"><i
                                            class="bi bi-download"></i></a>
                                    <a href=" {{ route('viewinvoice') }}?id={{$booking->id}}" class="btn btn-success"><i
                                            class="bi bi-eye"></i></a>
                                @endif

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    @endif





    <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="availabilityForm" method="POST" action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="availabilityModalLabel">Change Availability</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="booking_id" id="modalBookingId" value="">
                        <div class="mb-3">
                            <label for="availabilitySelect" class="form-label">Availability</label>
                            <select class="form-select" id="availabilitySelect" name="availability" required>
                                <option value="">select availability</option>
                                <option value="available">Available</option>
                                <option value="not_available">Not Available</option>
                            </select>
                        </div>
                        <div class="mb-3" id="checkoutDateContainer" style="display:none;">
                            <label for="checkoutDate" class="form-label">update Checkout Date</label>
                            <input type="date" class="form-control" id="checkoutDate" name="checkout_date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection


@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var exampleModal = document.getElementById('exampleModal');
            var modalBookingId = document.getElementById('modalBookingId');
            var availabilitySelect = document.getElementById('availabilitySelect');
            var checkoutDateContainer = document.getElementById('checkoutDateContainer');

            exampleModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var row = button.closest('tr');
                if (!row) return;
                var badge = row.querySelector('.availability-badge');
                if (!badge) return;
                var bookingId = badge.getAttribute('data-booking-id');
                var availability = badge.getAttribute('data-availability');

                modalBookingId.value = bookingId;
                availabilitySelect.value = availability;

                if (availability === 'not_available') {
                    checkoutDateContainer.style.display = 'none';
                } else {
                    checkoutDateContainer.style.display = 'block';
                }
            });

            availabilitySelect.addEventListener('change', function () {
                if (this.value === 'available') {
                    checkoutDateContainer.style.display = 'block';
                } else {
                    checkoutDateContainer.style.display = 'none';
                }
            });


            var availabilityForm = document.getElementById('availabilityForm');
            availabilityForm.addEventListener('submit', function (e) {
                e.preventDefault();

                var formData = new FormData(availabilityForm);
                var bookingId = formData.get('booking_id');
                var availability = formData.get('availability');
                var checkoutDate = formData.get('checkout_date');

                fetch('{{ route('booking.updateAvailability') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Update the availability badge and status text in the table row
                            var row = document.querySelector('span.availability-badge[data-booking-id="' + bookingId + '"]').closest('tr');
                            if (row) {
                                var badge = row.querySelector('span.availability-badge');
                                var statusCell = row.querySelector('td:nth-child(7)'); // Payment/status column

                                if (availability === 'available') {
                                    badge.textContent = 'Available';
                                    badge.classList.remove('bg-danger');
                                    badge.classList.add('bg-success');
                                    badge.setAttribute('data-availability', 'available');

                                    if (statusCell) {
                                        statusCell.innerHTML = '<span class="text-success">SUCCESS</span>';
                                    }
                                } else {
                                    badge.textContent = 'Not Available';
                                    badge.classList.remove('bg-success');
                                    badge.classList.add('bg-danger');
                                    badge.setAttribute('data-availability', 'not_available');

                                    if (statusCell) {
                                        statusCell.innerHTML = '<span class="text-danger">PENDING</span>';
                                    }
                                }
                            }
                            // Hide the modal
                            var modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
                            modal.hide();
                        } else {
                            alert('Failed to update availability: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        alert('Error updating availability: ' + error.message);
                    });
            });
        });
    </script>
    <script>

    </script>
@endsection