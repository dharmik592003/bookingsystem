
@extends('layout.layout')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #000000;
            --gold-color: #c8a97e;
            --light-bg: #f9f9f9;
        }
        
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #fff;
        }
        
        .support-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Header */
        .support-header {
            background-image: url('https://www.louxibiza.com/wp-content/uploads/2023/04/support-hero.jpg');
            background-size: cover;
            background-position: center;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
            margin-bottom: 40px;
        }
        
        .support-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .header-content {
            position: relative;
            z-index: 1;
            padding: 20px;
        }
        
.nav-tabs{
    display: flex;
    flex-direction: row;
}

        /* Tabs */
        .nav-tabs .nav-link {
            border: none;
            color: #666;
            font-weight: 500;
            padding: 12px 20px;
        }
        
        .nav-tabs .nav-link.active {
            color: var(--gold-color);
            border-bottom: 2px solid var(--gold-color);
            background: none;
        }
        
        /* Ticket List */
        .ticket-list {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        
        .ticket-item {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            transition: all 0.2s;
            cursor: pointer;
        }
        
        .ticket-item:hover {
            background-color: var(--light-bg);
        }
        
        .ticket-item.active {
            background-color: #f5f5f5;
            border-left: 3px solid var(--gold-color);
        }
        
        .ticket-status {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .status-open {
            background-color: #e3f2fd;
            color: #1976d2;
        }
        
        .status-pending {
            background-color: #fff8e1;
            color: #ff8f00;
        }
        
        .status-resolved {
            background-color: #e8f5e9;
            color: #388e3c;
        }
        
        /* Message Area */
        .message-area {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            height: 500px;
            display: flex;
            flex-direction: column;
        }
        
        .message-header {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            background-color: var(--light-bg);
        }
        
        .messages-container {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }
        
        .message {
            margin-bottom: 20px;
            max-width: 80%;
        }
        
        .customer-message {
            margin-right: auto;
            background-color: #f0f0f0;
            padding: 12px 15px;
            border-radius: 18px 18px 18px 4px;
        }
        
        .agent-message {
            margin-left: auto;
            background-color: var(--gold-color);
            color: white;
            padding: 12px 15px;
            border-radius: 18px 18px 4px 18px;
        }
        
        .message-time {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
            text-align: right;
        }
        
        .message-input {
            padding: 15px;
            border-top: 1px solid #eee;
            background-color: var(--light-bg);
        }
        
        .form-control {
            border-radius: 20px;
            border: 1px solid #ddd;
            padding: 10px 15px;
        }
        
        .btn-gold {
            background-color: var(--gold-color);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .btn-gold:hover {
            background-color: #b89a6d;
            color: white;
        }
        
        /* Admin Dashboard */
        .admin-sidebar {
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            padding: 20px 0;
        }
        
        .admin-nav a {
            color: #ecf0f1;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .admin-nav a:hover, .admin-nav a.active {
            background-color: #34495e;
            color: var(--gold-color);
        }
        
        .admin-nav i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .admin-content {
            padding: 20px;
            background-color: #f5f7fa;
        }
        
        .stats-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .stats-number {
            font-size: 24px;
            font-weight: 700;
            color: var(--gold-color);
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .message-area {
                height: 400px;
            }
        }
        
        @media (max-width: 768px) {
            .support-header {
                height: 200px;
            }
            
            .message {
                max-width: 90%;
            }
        }
    </style>
@endsection
@section('main')
<div class="support-header">
    <div class="header-content">
        <h1>Customer Support</h1>
        <p class="lead">We're here to help with any questions or issues</p>
    </div>
</div>
    <div class="support-container" id="customerView">
        
        <ul class=" nav-tabs mb-4" id="supportTabs" role="tablist">
            <li class="nav-item list-unstyled" role="presentation">
                <button class="nav-link active" id="new-tab" data-bs-toggle="tab" data-bs-target="#new" type="button" role="tab">New Ticket</button>
            </li>
            <li class="nav-item list-unstyled" role="presentation">
                <button class="nav-link" id="tickets-tab" data-bs-toggle="tab" data-bs-target="#tickets" type="button" role="tab">My Tickets</button>
            </li>
        </ul>
        
        <div class="tab-content" id="supportTabsContent">
            <!-- New Ticket Tab -->
            <div class="tab-pane fade show active" id="new" role="tabpanel">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h4 class="mb-4">Create New Support Ticket</h4>
                                <form id="newTicketForm">
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">Subject</label>
                                        <input type="text" class="form-control" id="subject" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="department" class="form-label">Department</label>
                                        <select class="form-select" id="department" required>
                                            <option value="">Select department</option>
                                            <option value="bookings">Bookings</option>
                                            <option value="payments">Payments</option>
                                            <option value="villas">Villa Rentals</option>
                                            <option value="yachts">Yacht Charter</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message</label>
                                        <textarea class="form-control" id="message" rows="5" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="attachments" class="form-label">Attachments (optional)</label>
                                        <input type="file" class="form-control" id="attachments" multiple>
                                    </div>
                                    <button type="submit" class="btn btn-gold">Submit Ticket</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- My Tickets Tab -->
             @if(Session::get('customer_id')==3)
            <div class="tab-pane fade" id="tickets" role="tabpanel">
                <div class="row">
                    <div class="col-md-4">
                        <div class="ticket-list">
                            <div class="ticket-item active">
                                <div class="d-flex justify-content-between">
                                    <h6>Booking modification request</h6>
                                    <span class="ticket-status status-open">Open</span>
                                </div>
                                <p class="text-muted mb-1">Villa Can Blas reservation</p>
                                <small class="text-muted">Last updated: 2 hours ago</small>
                            </div>
                            <div class="ticket-item">
                                <div class="d-flex justify-content-between">
                                    <h6>Payment issue</h6>
                                    <span class="ticket-status status-resolved">Resolved</span>
                                </div>
                                <p class="text-muted mb-1">Credit card declined</p>
                                <small class="text-muted">Last updated: 3 days ago</small>
                            </div>
                            <div class="ticket-item">
                                <div class="d-flex justify-content-between">
                                    <h6>Yacht charter question</h6>
                                    <span class="ticket-status status-resolved">Resolved</span>
                                </div>
                                <p class="text-muted mb-1">Availability for June</p>
                                <small class="text-muted">Last updated: 1 week ago</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="message-area">
                            <div class="message-header">
                                <h5>Booking modification request</h5>
                                <p class="mb-0">Ticket #LBZ-4821 | Created: 2023-06-15</p>
                            </div>
                            
                            <div class="messages-container">
                                <div class="message customer-message">
                                    <p>Hello, I would like to modify my booking for Villa Can Blas. We need to change the dates from July 10-17 to July 15-22. Is this possible?</p>
                                    <div class="message-time">June 15, 10:30 AM</div>
                                </div>
                                
                                <div class="message agent-message">
                                    <p>Hello Maria, thank you for contacting Louxi Ibiza. I've checked the availability and we can accommodate your request to change dates. The price difference will be €120 due to higher season rates. Please confirm if you'd like to proceed.</p>
                                    <div class="message-time">June 15, 11:45 AM</div>
                                </div>
                                
                                <div class="message customer-message">
                                    <p>Yes, that's fine. Please go ahead with the changes. Should I make the additional payment now?</p>
                                    <div class="message-time">June 15, 12:15 PM</div>
                                </div>
                            </div>
                            
                            <div class="message-input">
                                <form class="d-flex">
                                    <input type="text" class="form-control me-2" placeholder="Type your message...">
                                    <button class="btn btn-gold" type="submit">Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Admin View (normally this would be a separate page) -->
    <div class="d-none" id="adminView">
        <div class="row g-0">
            <div class="col-md-3">
                <div class="admin-sidebar">
                    <div class="text-center mb-4">
                        <h4>Louxi Ibiza</h4>
                        <p class="text-muted">Support Dashboard</p>
                    </div>
                    
                    <div class="admin-nav">
                        <a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        <a href="#"><i class="fas fa-inbox"></i> Tickets <span class="badge bg-danger float-end">3</span></a>
                        <a href="#"><i class="fas fa-users"></i> Customers</a>
                        <a href="#"><i class="fas fa-calendar"></i> Reservations</a>
                        <a href="#"><i class="fas fa-cog"></i> Settings</a>
                        <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-9">
                <div class="admin-content">
                    <h4 class="mb-4">Support Dashboard</h4>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="stats-card">
                                <h6>Open Tickets</h6>
                                <div class="stats-number">14</div>
                                <small class="text-muted">+2 from yesterday</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card">
                                <h6>Pending Replies</h6>
                                <div class="stats-number">8</div>
                                <small class="text-muted">Waiting for agent response</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card">
                                <h6>Resolved Today</h6>
                                <div class="stats-number">5</div>
                                <small class="text-muted">+3 from yesterday</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Recent Tickets</h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Ticket #</th>
                                            <th>Subject</th>
                                            <th>Customer</th>
                                            <th>Status</th>
                                            <th>Last Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>LBZ-4872</td>
                                            <td>Villa booking question</td>
                                            <td>James Wilson</td>
                                            <td><span class="ticket-status status-open">Open</span></td>
                                            <td>5 min ago</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>LBZ-4871</td>
                                            <td>Payment issue</td>
                                            <td>Sarah Johnson</td>
                                            <td><span class="ticket-status status-pending">Pending</span></td>
                                            <td>25 min ago</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>LBZ-4870</td>
                                            <td>Yacht charter inquiry</td>
                                            <td>Michael Brown</td>
                                            <td><span class="ticket-status status-open">Open</span></td>
                                            <td>1 hour ago</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>LBZ-4869</td>
                                            <td>Special requests</td>
                                            <td>Emma Davis</td>
                                            <td><span class="ticket-status status-resolved">Resolved</span></td>
                                            <td>2 hours ago</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Ticket Conversation</h5>
                            
                            <div class="message-area" style="height: auto;">
                                <div class="message-header d-flex justify-content-between">
                                    <div>
                                        <h6>Villa booking question</h6>
                                        <p class="mb-0">Ticket #LBZ-4872 | James Wilson</p>
                                    </div>
                                    <div>
                                        <select class="form-select form-select-sm" style="width: 150px;">
                                            <option>Open</option>
                                            <option>Pending</option>
                                            <option>Resolved</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="messages-container">
                                    <div class="message customer-message">
                                        <p>Hello, I'm interested in booking Villa Can Blas for August 15-22, but I have a question about the maximum occupancy. The website says 8 guests, but we have 10 in our group. Would it be possible to accommodate us?</p>
                                        <div class="message-time">June 16, 9:15 AM</div>
                                    </div>
                                    
                                    <div class="message agent-message">
                                        <p>Hello James, thank you for your inquiry. While Villa Can Blas officially accommodates 8 guests, we can arrange for 2 additional single beds in the living area for an extra €50 per night. Would this solution work for your group?</p>
                                        <div class="message-time">June 16, 9:30 AM <span class="badge bg-light text-dark">Agent: Sophia</span></div>
                                    </div>
                                </div>
                                
                                <div class="message-input">
                                    <form class="d-flex align-items-center">
                                        <input type="text" class="form-control me-2" placeholder="Type your reply...">
                                        <button class="btn btn-gold me-2" type="submit">Reply</button>
                                        <button class="btn btn-outline-secondary" type="button">Resolve</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // In a real implementation, this would connect to a backend
        document.getElementById('newTicketForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Ticket submitted successfully! Our team will respond within 24 hours.');
            this.reset();
        });
        
        // Simulate switching between customer and admin views
        // In reality these would be separate pages with proper authentication
        function showAdminView() {
            document.getElementById('customerView').classList.add('d-none');
            document.getElementById('adminView').classList.remove('d-none');
        }
        
        function showCustomerView() {
            document.getElementById('adminView').classList.add('d-none');
            document.getElementById('customerView').classList.remove('d-none');
        }
        
        // Uncomment to test admin view
        // showAdminView();
    </script>
@endsection

