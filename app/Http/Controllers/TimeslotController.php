<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Agency;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class TimeslotController extends Controller
{
    // Check timeslot availability
    public function checkAvailability(Request $request, $serviceId)
    {
        $service = Service::findOrFail($serviceId);
        $date = Carbon::parse($request->date);
        
        // Get booked slots
        $bookedSlots = Booking::where('service_id', $serviceId)
            ->where('status', 'APPROVED')
            ->whereDate('from', $date)
            ->get(['check_in', 'check_out']);

        // Generate available slots based on service type
        $slots = [];
        $startTime = Carbon::createFromTime(8, 0, 0); // 8 AM
        $endTime = Carbon::createFromTime(20, 0, 0); // 8 PM

        if ($service->booking_type === 'hourly') {
            $interval = 60; // 1 hour intervals
            $current = $startTime->copy();

            while ($current <= $endTime) {
                $slotEnd = $current->copy()->addMinutes($interval);
                $isAvailable = $this->isSlotAvailable($current, $slotEnd, $bookedSlots);
                
                $slots[] = [
                    'start' => $current->format('H:i'),
                    'end' => $slotEnd->format('H:i'),
                    'available' => $isAvailable
                ];
                
                $current->addMinutes($interval);
            }
        } 
        elseif ($service->booking_type === 'daily') {
            // Check if date is available
            $isBooked = Booking::where('service_id', $serviceId)
                ->where('status', 'APPROVED')
                ->whereDate('from', '<=', $date)
                ->whereDate('to', '>=', $date)
                ->exists();

            $slots[] = [
                'start' => '00:00',
                'end' => '23:59',
                'available' => !$isBooked
            ];
        }
        elseif ($service->booking_type === 'nightly') {
            $nightStart = Carbon::parse($service->night_start);
            $nightEnd = Carbon::parse($service->night_end);

            $isBooked = Booking::where('service_id', $serviceId)
                ->where('status', 'APPROVED')
                ->whereDate('from', $date)
                ->whereTime('check_in', '<=', $nightEnd)
                ->whereTime('check_out', '>=', $nightStart)
                ->exists();

            $slots[] = [
                'start' => $nightStart->format('H:i'),
                'end' => $nightEnd->format('H:i'),
                'available' => !$isBooked
            ];
        }

        return response()->json($slots);
    }

    // Validate timeslot
    public function validateTimeslot(Request $request, $serviceId)
    {
        $service = Service::findOrFail($serviceId);
        $validator = Validator::make($request->all(), [
            'start' => 'required|date',
            'end' => 'required|date|after:start'
        ]);

        if ($validator->fails()) {
            return response()->json(['valid' => false, 'errors' => $validator->errors()]);
        }

        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);

        // Check minimum duration
        if ($service->booking_type === 'hourly' && $start->diffInHours($end) < $service->min_hours) {
            return response()->json([
                'valid' => false,
                'message' => "Minimum booking duration is {$service->min_hours} hours"
            ]);
        }

        if (in_array($service->booking_type, ['daily', 'nightly']) && $start->diffInDays($end) < $service->min_days) {
            return response()->json([
                'valid' => false,
                'message' => "Minimum booking duration is {$service->min_days} days"
            ]);
        }

        // Check availability
        $isAvailable = $this->checkSlotAvailability($serviceId, $start, $end);
        
        return response()->json([
            'valid' => $isAvailable,
            'message' => $isAvailable ? 'Timeslot available' : 'Timeslot not available'
        ]);
    }

    // Helper function to check slot availability
    protected function checkSlotAvailability($serviceId, $start, $end)
    {
        return !Booking::where('service_id', $serviceId)
            ->where('status', 'APPROVED')
            ->where(function($query) use ($start, $end) {
                $query->whereBetween('from', [$start, $end])
                      ->orWhereBetween('to', [$start, $end])
                      ->orWhere(function($q) use ($start, $end) {
                          $q->where('from', '<=', $start)
                            ->where('to', '>=', $end);
                      });
            })
            ->exists();
    }

    // Helper function to check if specific time slot is available
    protected function isSlotAvailable($slotStart, $slotEnd, $bookedSlots)
    {
        foreach ($bookedSlots as $booking) {
            $bookingStart = Carbon::parse($booking->check_in);
            $bookingEnd = Carbon::parse($booking->check_out);

            if (($slotStart >= $bookingStart && $slotStart < $bookingEnd) ||
                ($slotEnd > $bookingStart && $slotEnd <= $bookingEnd) ||
                ($slotStart <= $bookingStart && $slotEnd >= $bookingEnd)) {
                return false;
            }
        }
        return true;
    }

    // Get service booking configuration
    public function getServiceConfig($serviceId)
    {
        $service = Service::findOrFail($serviceId);
        return response()->json([
            'booking_type' => $service->booking_type,
            'min_hours' => $service->min_hours,
            'min_days' => $service->min_days,
            'night_start' => $service->night_start,
            'night_end' => $service->night_end
        ]);
    }
}
