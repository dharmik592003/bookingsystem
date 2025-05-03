<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Cart;
use Carbon\Carbon;

class NewBookingController extends Controller
{
    /**
     * Check availability for all items in cart
     */
    public function checkCartAvailability(Request $request)
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('service')->get();
        $availability = [];
        $bookingDate = $request->input('booking_date');
        
        foreach ($cartItems as $item) {
            $available = $this->checkServiceAvailability(
                $item->service_id,
                $bookingDate,
                $item->quantity
            );
            
            $availability[] = [
                'service_id' => $item->service_id,
                'available' => $available,
                'date' => $bookingDate
            ];
        }

        return response()->json(['availability' => $availability]);
    }

    /**
     * Process booking for available cart items
     */
    public function processCartBooking(Request $request)
    {
        $validated = $request->validate([
            'booking_date' => 'required|date',
            'items' => 'required|array'
        ]);

        $bookings = [];
        
        foreach ($request->items as $item) {
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'service_id' => $item['service_id'],
                'booking_date' => $validated['booking_date'],
                'quantity' => $item['quantity'],
                'status' => Booking::STATUS_CONFIRMED,
                'payment_status' => Booking::PAYMENT_PENDING
            ]);
            
            $bookings[] = $booking;
        }

        // Clear cart after successful booking
        Cart::where('user_id', auth()->id())->delete();

        return response()->json([
            'success' => true,
            'bookings' => $bookings
        ]);
    }

    /**
     * Check if a service is available for booking
     */
    private function checkServiceAvailability($serviceId, $date, $quantity)
    {
        $service = Service::findOrFail($serviceId);
        $bookingDate = Carbon::parse($date);
        
        // Check service capacity
        $existingBookings = Booking::where('service_id', $serviceId)
            ->whereDate('booking_date', $bookingDate)
            ->sum('quantity');
            
        return ($service->capacity - $existingBookings) >= $quantity;
    }
}
