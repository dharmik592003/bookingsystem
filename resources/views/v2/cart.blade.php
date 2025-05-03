@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Your Booking Cart</h1>
    
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Services in Cart</h5>
        </div>
        
        <div class="card-body">
            <div id="cart-items-container">
                <!-- Cart items will be loaded here via AJAX -->
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="booking-date" class="form-label">Booking Date</label>
                        <input type="date" class="form-control" id="booking-date" min="{{ date('Y-m-d') }}">
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <button id="check-availability-btn" class="btn btn-primary">
                    Check Availability
                </button>
                <button id="book-now-btn" class="btn btn-success" disabled>
                    Book Available Services
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Availability Results Modal -->
<div class="modal fade" id="availabilityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Availability Results</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="availability-results">
                <!-- Availability results will be shown here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Load cart items
    loadCartItems();
    
    // Check availability button click
    $('#check-availability-btn').click(function() {
        const date = $('#booking-date').val();
        if (!date) {
            alert('Please select a booking date');
            return;
        }
        
        checkAvailability(date);
    });
    
    // Book now button click
    $('#book-now-btn').click(function() {
        processBooking();
    });
});

function loadCartItems() {
    $.get('/cart', function(data) {
        $('#cart-items-container').html(data);
    });
}

function checkAvailability(date) {
    $('#check-availability-btn').prop('disabled', true).html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Checking...'
    );
    
    $.get('/v2/cart/availability', { booking_date: date }, function(response) {
        $('#availability-results').html('');
        
        response.availability.forEach(function(item) {
            const status = item.available ? 
                '<span class="badge bg-success">Available</span>' : 
                '<span class="badge bg-danger">Unavailable</span>';
                
            $('#availability-results').append(
                `<div class="mb-2">
                    <strong>Service #${item.service_id}</strong>: ${status} for ${item.date}
                </div>`
            );
        });
        
        $('#availabilityModal').modal('show');
        $('#book-now-btn').prop('disabled', !response.availability.every(i => i.available));
    })
    .always(function() {
        $('#check-availability-btn').prop('disabled', false).text('Check Availability');
    });
}

function processBooking() {
    const date = $('#booking-date').val();
    
    $('#book-now-btn').prop('disabled', true).html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...'
    );
    
    $.post('/v2/cart/book', { 
        booking_date: date,
        _token: '{{ csrf_token() }}'
    }, function(response) {
        if (response.success) {
            window.location.href = '/bookings/' + response.bookings[0].id;
        }
    })
    .fail(function() {
        alert('Error processing booking');
        $('#book-now-btn').prop('disabled', false).text('Book Available Services');
    });
}
</script>
@endpush
@endsection
