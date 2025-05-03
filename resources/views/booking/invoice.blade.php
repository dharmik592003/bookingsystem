<!DOCTYPE html>
<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        body {

            font-family: serif;
        }

        .header {

            text-align: center;
            margin-bottom: 20px;
        }

        .details {
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #D4AF37;
        }

        .total {
            text-align: center;
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="{{ asset('images/Group 1.svg') }}" alt="" class="logo" style="width: 100px; height: auto;">
                <p>Get your luxurious life</p>
            </div>
            <h1>Booking Invoice</h1>
            <p>Invoice #{{ $booking->id }}</p>
            <p>Date: {{ now()->format('Y-m-d') }}</p>
        </div>
        <div class="details">
            <p><strong>Customer:</strong> {{ $booking->customer->name }}</p>
            <p><strong>Email:</strong> {{ $booking->customer->email }}</p>
            <p><strong>Phone:</strong> {{ $booking->customer->phone }}</p>
            <p><strong>Booking Date:</strong> {{ $booking->created_at->format('Y-m-d') }}</p>
        </div>

        <table>
            <thead>
            <tr>
                <th>Service</th>
                <th>Description</th>
                <th>Days</th>
                <th>Total Hours</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $booking->service->name }}</td>
                <td>
                @php
                    $additionalInfo = json_decode($invoice['additional_info'], true);
                @endphp
                @if(is_array($additionalInfo))
                    @foreach($additionalInfo as $key => $value)
                    <strong>{{ ucfirst($key) }}:</strong> {{ $value }}<br>
                    @endforeach
                @else
                    {{ $invoice['additional_info'] }}
                @endif
                </td>
                <td>{{ $invoice['days'] }}</td>
                <td>{{ $invoice['total_hours'] }}</td>
                <td>₹{{ number_format((float) $invoice['bill'], 2) }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Company commission = % {{ $invoice['commission'] }}</td>
                <td></td>
                <td></td>
                <td>₹
                +{{ number_format(((float) $invoice['bill'] * ((float) $invoice['commission'] / 100)), 2) }}
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>- Discount = % {{ $invoice['discount'] }}</td>
                <td></td>
                <td>₹
                -{{ number_format(((float) $invoice['bill'] * ((float) $invoice['discount'] / 100)), 2) }}
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td></td>
                <td colspan="3" class="total text-center">Total:</td>
                <td>₹{{ number_format(((float) $invoice['bill'] + ((float) $invoice['bill'] * ((float) $invoice['commission'] / 100)) - ((float) $invoice['bill'] * ((float) $invoice['discount'] / 100))), 2) }}</td>
            </tr>
            </tfoot>
        </table>

        <div class="info d-flex justify-content-between mt-4">
            <p><strong>Company Name:</strong> Luxurious Life</p>
            <p><strong>Address:</strong> 123, Main Street, Mumbai, India</p>
            <p><strong>Phone:</strong> +91 123 456 7890</p>
            <p><strong>Email:</strong> info@luxuriouslife.com</p>
            <p><strong>GSTIN:</strong> 12ABCD1234E1Z5</p>
            <p><strong>PAN:</strong> ABCDE1234E</p>
        </div>


    </div>
    <p class="text-center mt-4">Thank you for choosing Luxurious Life.</p>
    <p class="text-center">We appreciate your business and look forward to serving you again.</p>
    </div>
    </div>
    Last updated on: {{ now()->format('Y-m-d') }}
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>

</html>