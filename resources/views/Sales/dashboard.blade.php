@extends('layout.layout')

@section('main')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Sales Analytics Dashboard</h1>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Bookings</h5>
                    <p class="card-text display-4">{{ number_format($totalBookings) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Services</h5>
                    <p class="card-text display-4">{{ number_format($totalServices) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Top Service</h5>
                    <p class="card-text">{{ $topSellingService->name ?? 'N/A' }}</p>
                    <p class="card-text">{{ $topSellingService->bookings_count ?? 0 }} bookings</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Sales Performance</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="salesChart" height="200"></canvas>
                        </div>
                        <div class="col-md-6">
                            <canvas id="revenueChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Bookings</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Service</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Profit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings->take(10) as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->service->name }}</td>
                                    <td>{{ $booking->booking_date->format('M d, Y') }}</td>
                                    <td>${{ number_format($booking->total_amount, 2) }}</td>
                                    <td>${{ number_format($booking->profit, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Sales Volume Chart
    new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: {
            labels: @json($salesGraphLabels),
            datasets: [{
                label: 'Bookings',
                data: @json($salesGraphData),
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Daily Bookings Volume'
                }
            }
        }
    });

    // Revenue Chart
    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels: @json($revenueGraphLabels),
            datasets: [{
                label: 'Revenue ($)',
                data: @json($revenueGraphData),
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Daily Revenue'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush
@endsection
