<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class TimeSlotService
{
    public function calculate(Request $request, int $typeid): array
    {
        $start = Carbon::parse($request->input('from') . ' ' . $request->input('checkin_time'));
        $end = Carbon::parse($request->input('to') . ' ' . $request->input('checkout_time'));

        switch ($typeid) {
            case 1: // Hotel/Villa
                return [
                    'days' => $start->diffInDays($end) + 1,
                    'total_hours' => ($start->diffInDays($end) + 1) * 24,
                    'calculation_type' => 'daily'
                ];

            case 2: // Charter Plane
                return [
                    'hours' => $start->diffInHours($end),
                    'total_hours' => $start->diffInHours($end),
                    'calculation_type' => 'hourly'
                ];

            case 3: // Yacht
                $hours = $start->diffInHours($end);
                $days = $start->diffInDays($end) + 1;
                
                return $request->input('rental_type') == 'hourly' ? [
                    'hours' => $hours,
                    'total_hours' => $hours,
                    'calculation_type' => 'hourly'
                ] : [
                    'days' => $days,
                    'total_hours' => $days * 24,
                    'calculation_type' => 'daily'
                ];

            case 4: // Car
                if ($request->input('rental_type') == 'self_drive') {
                    $hours = $start->diffInHours($end);
                    $days = $start->diffInDays($end) + 1;
                    
                    return $hours < 24 ? [
                        'hours' => $hours,
                        'total_hours' => $hours,
                        'calculation_type' => 'hourly'
                    ] : [
                        'days' => $days,
                        'total_hours' => $days * 24,
                        'calculation_type' => 'daily'
                    ];
                } else {
                    return [
                        'days' => $start->diffInDays($end) + 1,
                        'distance' => $request->input('distance'),
                        'total_hours' => ($start->diffInDays($end) + 1) + $request->input('distance'),
                        'calculation_type' => 'distance_based'
                    ];
                }

            default:
                throw new \InvalidArgumentException("Invalid service type");
        }
    }
}
