<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\payment;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use App\payment_status;
use App\Status;
use Session;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display sales dashboard.
     */
    public function index()
    {
        $user = User::where('id', '=', Session::get('loginid'))->first();
        $bookings = booking::all();
        $services = service::all();
        $totalBookings = booking::count();
        $totalServices = service::count();
        return view('Sales.index', compact('bookings','user', 'services', 'totalBookings', 'totalServices'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function createBooking()
    {
        $services = service::all();
        return view('Sales.create_booking', compact('services'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function storeBooking(Request $request)
    {
        $booking = new booking();
        $booking->service_id = $request->service_id;
        $booking->user_id = auth()->id();
        $booking->booking_date = $request->booking_date;
        $booking->save();
        return redirect()->route('Sales.index');
    }

    /**
     * Display the specified booking.
     */
    public function showBooking(string $id)
    {
        $booking = booking::find($id);
        return view('Sales.show_booking', compact('booking'));
    }

    /**
     * Show the form for editing the specified booking.
     */
    public function editBooking(string $id)
    {
        $booking = booking::find($id);
        $services = service::all();
        return view('Sales.edit_booking', compact('booking', 'services'));
    }

    /**
     * Update the specified booking in storage.
     */
    public function updateBooking(Request $request, string $id)
    {
        $booking = booking::find($id);
        $booking->service_id = $request->service_id;
        $booking->booking_date = $request->booking_date;
        $booking->save();
        return redirect()->route('Sales.index');
    }

    /**
     * Remove the specified booking from storage.
     */
    public function destroyBooking(string $id)
    {
        $booking = booking::find($id);
        $booking->delete();
        return redirect()->route('Sales.index');
    }

    /**
     * Show the form for creating a new service.
     */
    public function createService()
    {
        return view('Sales.create_service');
    }

    /**
     * Store a newly created service in storage.
     */
    public function storeService(Request $request)
    {
        $service = new service();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();
        return redirect()->route('Sales.index');
    }

    /**
     * Display the specified service.
     */
    public function showService(string $id)
    {
        $service = service::find($id);
        return view('Sales.show_service', compact('service'));
    }

    /**
     * Show the form for editing the specified service.
     */
    public function editService(string $id)
    {
        $service = service::find($id);
        return view('Sales.edit_service', compact('service'));
    }

    /**
     * Update the specified service in storage.
     */
    public function updateService(Request $request, string $id)
    {
        $service = service::find($id);
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();
        return redirect()->route('Sales.index');
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroyService(string $id)
    {
        $service = service::find($id);
        $service->delete();
        return redirect()->route('Sales.index');
    }
 
    public function salesDashboard()
    {
        $user = User::where('id', '=', Session::get('loginid'))->first();
        $totalBookings = Booking::count();
        $totalServices = Service::count();
        $topSellingService = Service::withCount('bookings')
            ->orderByDesc('bookings_count')
            ->first();
        $monthlyTarget = Setting::getValue('monthly_target', 0);
        $yearlyTarget = Setting::getValue('yearly_target', 0);

        // Initialize arrays for graph data
        $salesGraphLabels = [];
        $salesGraphData = [];
        $revenueGraphLabels = [];
        $revenueGraphData = [];
        $profitGraphLabels = [];
        $profitGraphData = [];

        // Get completed and paid bookings
        $bookings = payment::where('payment_status', Status::APPROVED)
                        ->where('payment_status', payment_status::DONE)
                        ->with('booking')
                        ->get();

        // Group bookings by date for proper chart display
        $groupedBookings = $bookings->groupBy(function($booking) {
            return $booking->booking_date->format('Y-m-d');
        });

        // Populate graph data arrays
        foreach ($groupedBookings as $date => $dailyBookings) {
            $salesGraphLabels[] = $date;
            $salesGraphData[] = $dailyBookings->sum('quantity');
            
            $revenueGraphLabels[] = $date;
            $revenueGraphData[] = $dailyBookings->sum('total_amount');
            
            $profitGraphLabels[] = $date;
            $profitGraphData[] = $dailyBookings->sum(function($booking) {
                return $booking->total_amount - $booking->cost;
            });
        }

        return view('sales.dashboard', compact(
            'user',
            'totalBookings',
            'totalServices',
            'topSellingService',
            'monthlyTarget',
            'yearlyTarget',
            'salesGraphLabels',
            'salesGraphData',
            'revenueGraphLabels',
            'revenueGraphData',
            'profitGraphLabels',
            'profitGraphData',
            'bookings'
        ));
    }
}
