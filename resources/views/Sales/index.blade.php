@extends('layout.layout')
@section('main')

<div class="sales-dashboard">
  <div class="dashboard-header">
    <h1>Sales Dashboard</h1>
    <p>Track your sales performance and stay on top of your goals.</p>
    <div class="dashboard-actions">
      <button class="btn btn-primary">New Sale</button>
      <button class="btn btn-secondary">View Reports</button>
    </div>
  </div>
  <div class="dashboard-content">
    <div class="row">
      <div class="col-md-4">
        <div class="sales-overview">
          <h2>Sales Overview</h2>
          <div class="sales-stats">
            <div class="stat">
              <h3>Total Bookings</h3>
              <p>{{ $totalBookings }}</p>
            </div>
            <div class="stat">
              <h3>Total Services</h3>
              <p>{{ $totalServices }}</p>
            </div>
            <div class="stat">
              <h3>Top Selling Service</h3>
              <p>Service Name</p>
            </div>
          </div>
        </div>
      </div>
    <div class="col-md-4">
  <div class="sales-graph">
    <h2>Sales Graph</h2>
    <div class="graph">
      <canvas id="salesGraph" width="400" height="200"></canvas>
      <script>
        var ctx = document.getElementById('salesGraph').getContext('2d');
        var chart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: {!! json_encode($salesGraphLabels) !!},
            datasets: [{
              label: 'Sales',
              data: {!! json_encode($salesGraphData) !!},
              backgroundColor: 'rgba(255, 99, 132, 0.2)',
              borderColor: 'rgba(255, 99, 132, 1)',
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true
                }
              }]
            }
          }
        });
      </script>
    </div>
  </div>
</div>
<div class="col-md-4">
  <div class="sales-graph">
    <h2>Revenue Graph</h2>
    <div class="graph">
      <canvas id="revenueGraph" width="400" height="200"></canvas>
      <script>
        var ctx = document.getElementById('revenueGraph').getContext('2d');
        var chart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: {!! json_encode($revenueGraphLabels) !!},
            datasets: [{
              label: 'Revenue',
              data: {!! json_encode($revenueGraphData) !!},
              backgroundColor: 'rgba(54, 162, 235, 0.2)',
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true
                }
              }]
            }
          }
        });
      </script>
    </div>
  </div>
</div>
<div class="col-md-4">
  <div class="sales-graph">
    <h2>Profit Graph</h2>
    <div class="graph">
      <canvas id="profitGraph" width="400" height="200"></canvas>
      <script>
        var ctx = document.getElementById('profitGraph').getContext('2d');
        var chart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: {!! json_encode($profitGraphLabels) !!},
            datasets: [{
              label: 'Profit',
              data: {!! json_encode($profitGraphData) !!},
              backgroundColor: 'rgba(255, 206, 86, 0.2)',
              borderColor: 'rgba(255, 206, 86, 1)',
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true
                }
              }]
            }
          }
        });
      </script>
    </div>
  </div>
</div>
      <div class="col-md-4">
        <div class="sales-target">
          <h2>Sales Target</h2>
          <div class="target-stats">
            <div class="stat">
              <h3>Monthly Target</h3>
              <p>${{ $monthlyTarget }}</p>
            </div>
            <div class="stat">
              <h3>Yearly Target</h3>
              <p>${{ $yearlyTarget }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="sales-table">
          <h2>Sales Table</h2>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Date</th>
                <th>Service</th>
                <th>Quantity</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              @foreach($bookings as $booking)
              <tr>
                <td>{{ $booking->booking_date }}</td>
                <td>{{ $booking->service->name }}</td>
                <td>{{ $booking->quantity }}</td>
                <td>${{ $booking->amount }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection