<?php

namespace App\Http\Controllers;
use App\Models\booking;
use Illuminate\Http\Request;
use App\Models\service;
use Session;
use Validator;
use App\Models\User;
use App\Models\payment;
use App\Status;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Barryvdh\DomPDF\Facade\Pdf;
class BookingController extends Controller  implements HasMiddleware
{
    public static function middleware(): array {
        return [
            new Middleware('permission:User View',  ['index']),
            new Middleware('permission:User Edit',  ['edit']),
            new Middleware('permission:User Create',  ['create']),
            new Middleware('permission:User Delete',  ['delete']),
        ];
    }


    public function bookingspage()
    {
        if(Session::get('customer_id') == 1){
            $user = User::where('id', '=', Session::get('loginid'))->first();
            $bookings = booking::get()->all();
            return view('booking.index', ['user' => $user, 'bookings' => $bookings]);
        }
        elseif(Session::get('customer_id') == 3){
            $user = User::where('id', '=', Session::get('loginid'))->first();
            $bookings = booking::where('agency_id', '=', Session::get('agency_id'))->with('agency', 'service')->get()->all();
            return view('booking.index', ['user' => $user, 'bookings' => $bookings]);
        }
      elseif(Session::get('customer_id')==2){
        $user = User::where('id', '=', Session::get('loginid'))->first();
        $bookings = booking::where('user_id', '=', Session::get('loginid'))->with('agency', 'service')->get()->all();
        return view('booking.index', ['user' => $user, 'bookings' => $bookings]);
    }}
    public function index(Request $request, $id)
    {
        $user = User::where('id', '=', Session::get('loginid'))->first();
        $service = service::where('id', '=', $id)->with('agency')->first();
        return view('booking.bookingpage', ['service' => $service, 'user' => $user]);
    }
    public function cart(booking $booking)
    {
        $agent = User::where('id', '=', Session::get('loginid'))->first();
        $user = booking::where('user_id', '=', Session::get('loginid'))->with('customer', 'service')->get();
        if (!empty(session('cart'))) {
            $cart = session('cart');

            // $service = service::where('id', '=', $cart[$i])->get();
            $flattenedIds = array_column($cart, 'service_id');
            $service = service::whereIn('id', $flattenedIds)->get();
            // dd($service);    
            // dd($flattenedIds);
            return view('booking.Cart', ['users' => $user, 'user' => $agent, 'services' => $service]);
        } else {
            return view('booking.Cart', ['users' => $user, 'user' => $agent]);
        }
    }
    public function addtocart($service_id)
    {
        $cart = session()->get('cart', []);

        // Check if service already exists in cart
        if (!in_array($service_id, array_column($cart, 'service_id'))) {
            $cart[] = [
                'service_id' => $service_id,
                'added_at' => now()
            ];

            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Service added to cart',
                'cart_count' => count($cart)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Service already in cart',
            'cart_count' => count($cart)
        ]);
    }
    public function removefromcart($card)
    {
        if (Session::has('cart')) {
            $cart = session('cart');
            foreach ($cart as $key => $value) {
                if ($value['service_id'] == $card) {
                    unset($cart[$key]);
                    session()->put('cart', $cart);
                    return response()->json([
                        'success' => true,
                        'message' => 'Service removed from cart',
                        'cart_count' => count($cart)
                    ]);
                }
            }
        }
    }



    public function Store(Request $request, $category_id, $services_id)
    {

        $service = service::where('id', '=', $services_id)->first();


        if ($service->category_id == 1) {
            $checkin_time = $request->checkin_time;
            $checkout_time = $request->checkout_time;


            $checkinTime = Carbon::createFromFormat('Y-m-d H:i', $request->from . ' ' . $checkin_time, $request->timezone);
            $checkoutTime = Carbon::createFromFormat('Y-m-d H:i', $request->to . ' ' . $checkout_time, $request->timezone);


            $checkinTime->setTimezone('UTC');
            $checkoutTime->setTimezone('UTC');

            $interval = $checkinTime->diff($checkoutTime);
            $totalDays = $interval->d;
            $totalHours = $interval->h;

            $pricePerNight = $service->price;
            $totalAmount = $pricePerNight * $totalDays;
            $totalPayment = $totalAmount;
        } elseif (in_array($service->category_id, [2, 3, 4])) {
            $checkin_time = $request->checkin_time;
            $checkout_time = $request->checkout_time;
            $checkinTime = Carbon::createFromFormat('Y-m-d H:i', $request->from . ' ' . $checkin_time, $request->timezone);
            $checkoutTime = Carbon::createFromFormat('Y-m-d H:i', $request->to . ' ' . $checkout_time, $request->timezone);
            $checkinTime->setTimezone('UTC');
            $checkoutTime->setTimezone('UTC');
            $interval = $checkinTime->diff($checkoutTime);
            $totalHours = $interval->h + ($interval->d * 24);
            $totalKm = $request->total_km;
            $pricePerHour = $service->price;
            $pricePerKm = $request->price_per_km;
            $fuelPrice = $request->fuel_price;
            $totalAmount = ($pricePerHour * $totalHours) + ($pricePerKm * $totalKm) + $fuelPrice;
            $totalPayment = $totalAmount;
        }


        // if($service->category_id == 1){
// $checkin_time = $request->checkin_time;
// $checkout_time = $request->checkout_time;
// $checkinTime = Carbon::createFromFormat('Y-m-d H:i', $request->from . ' ' . $checkin_time);
// $checkoutTime = Carbon::createFromFormat('Y-m-d H:i', $request->to . ' ' . $checkout_time);
// $interval = $checkinTime->diff($checkoutTime);
// $totalDays = $interval->d ;
// $totalHours = $interval->h;
// $pricePerNight = $service->price;
// $totalAmount = $pricePerNight * $totalDays;
// $totalPayment = $totalAmount;
// }

        // elseif($service->category_id == 2 || $service->category_id == 3 || $service->category_id == 4){
// $checkin_time = $request->checkin_time;
// $checkout_time = $request->checkout_time;
// $checkinTime = Carbon::createFromFormat('Y-m-d H:i', $request->from . ' ' . $checkin_time);
// $checkoutTime = Carbon::createFromFormat('Y-m-d H:i', $request->to . ' ' . $checkout_time);
// $interval = $checkinTime->diff($checkoutTime);
// $totalHours = $interval->h + ($interval->d * 24);
// $totalKm = $request->total_km;
// $pricePerHour = $service->price;
// $pricePerKm = $request->price_per_km;
// $fuelPrice = $request->fuel_price;
// $totalAmount = ($pricePerHour * $totalHours) + ($pricePerKm * $totalKm) + $fuelPrice;
// $totalPayment = $totalAmount;
// }

        //     $booking = new booking();
//     $booking->service_id = $service_id;
//     $booking->user_id = Session::get('loginid');
//     $isbooked = booking::where('service_id', '=', $service_id)->where('categoryservice_id', '=', $category_id)->whereDate('from', '<=', $request->from)->whereDate('to', '>=', $request->to)->whereTime('check_in', '<=', $request->checkin_time)->whereTime('check_out', '>=', $request->checkout_time)->where('status', '=', 'APPROVED')->get();
//     $booking->agency_id = service::where('id', '=', $service_id)->get('agency_id')->value('agency_id');
//     $booking->user_id = Session::get('customer_id');
//     if (blank($isbooked)) {
//         $booking->from = $request->from;
//         $booking->to = $request->to;
//         $booking->adults = $request->adults;
//         $booking->children = $request->children;
//         $booking->pets = $request->pets;
//         $booking->check_in = $request->checkin_time;
//         $booking->check_out = $request->checkout_time;
//         $booking->save();
//         return back()->with('success', 'your booking is done success');
//     } elseif (!blank($isbooked)) {
//         return back()->with('fail', 'already booked please select other date');
//     }
// }

        $booking = new booking();
        $booking->service_id = $services_id;
        $booking->user_id = Session::get('loginid');
        $isbooked = booking::where('service_id', '=', $services_id)->where('categoryservice_id', '=', $category_id)->whereDate('from', '<=', $request->from)->whereDate('to', '>=', $request->to)->whereTime('check_in', '<=', $request->checkin_time)->whereTime('check_out', '>=', $request->checkout_time)->where('status', '=', 'APPROVED')->get();
        $booking->agency_id = service::where('id', '=', $services_id)->get('agency_id')->value('agency_id');
        $booking->user_id = Session::get('customer_id');
        if (blank($isbooked)) {
            $booking->from = $request->from;
            $booking->to = $request->to;
            $booking->adults = $request->adults;
            $booking->children = $request->children;
            $booking->pets = $request->pets;
            $booking->check_in = $request->checkin_time;
            $booking->check_out = $request->checkout_time;
            $booking->save();
            return back()->with('success', 'your booking is done success');
        } elseif (!blank($isbooked)) {
            return back()->with('fail', 'already booked please select other date');
        }

    }
    public function status(Request $request, $id)
    {
     
        $service = booking::where('id', '=', $id)->first();
        $service->status = $request->status;
        $service->save();
        $payment = payment::where('booking_id', '=', $id)->first();
        $payment->payment_status = 'Success';
        $payment->save();
        return back()->with('Success' ,"booking is done");
    }


    protected function isSlotAvailable($slotStart, $slotEnd, $bookedSlots)
    {
        foreach ($bookedSlots as $booking) {
            $bookingStart = Carbon::parse($booking->check_in);
            $bookingEnd = Carbon::parse($booking->check_out);

            if (
                ($slotStart->between($bookingStart, $bookingEnd)) ||
                ($slotEnd->between($bookingStart, $bookingEnd)) ||
                ($slotStart <= $bookingStart && $slotEnd >= $bookingEnd)
            ) {
                return false;
            }
        }
        return true;
    }

    protected function isSlotBooked($booking, $date, $slotStart, $slotEnd)
    {
        $bookingDate = Carbon::parse($booking['from']);
        if (!$bookingDate->isSameDay($date)) {
            return false;
        }

        $bookingStart = Carbon::parse($booking['check_in'])->format('H:i');
        $bookingEnd = Carbon::parse($booking['check_out'])->format('H:i');

        return ($slotStart >= $bookingStart && $slotStart < $bookingEnd) ||
            ($slotEnd > $bookingStart && $slotEnd <= $bookingEnd);
    }


public function availability(Request $request, $serviceId, $typeId = null)
    {
        $service = Service::where('id', '=', $serviceId)->with('types')->first();
        $date = Carbon::parse($request->date);

        // Get booked slots
        $bookedSlots = Booking::where('service_id', $serviceId)
            ->where('status', 'APPROVED')
            ->whereDate('from', $date)
            ->get(['from', 'to', 'check_in', 'check_out']);

        // Generate available slots based on service category
        $slots = [];
        $startTime = Carbon::createFromTimeString($service->booking_start);
        $endTime = Carbon::createFromTimeString($service->booking_end);

        if ($service->category_id == 1) {
            // Nightly booking
            $nightStart = Carbon::parse($service->booking_start);
            $nightEnd = Carbon::parse($service->booking_end);

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
        elseif ($service->category_id == 2) {
            // Hourly booking
            $interval = $service->types->booking_time; // 1 hour intervals
            $current = $startTime->copy();

            while ($current <= $endTime) {
                $slotEnd = $current->copy()->addHours($interval);
                $isAvailable = $this->isSlotAvailable($current, $slotEnd, $bookedSlots);

                $slots[] = [
                    'start' => $current->format('H:i'),
                    'end' => $slotEnd->format('H:i'),
                    'available' => $isAvailable
                ];

                $current->addHours($interval);
            }
        } 
        elseif ($service->category_id == 3) {
            // Count hours for category 3
            $interval = $service->types->booking_time; // 1 hour intervals
            $current = $startTime->copy();

            while ($current <= $endTime) {
                $slotEnd = $current->copy()->addHours($interval);
                $isAvailable = $this->isSlotAvailable($current, $slotEnd, $bookedSlots);

                $slots[] = [
                    'start' => $current->format('H:i'),
                    'end' => $slotEnd->format('H:i'),
                    'available' => $isAvailable
                ];

                $current->addHours($interval);
            }
        } 
        elseif ($service->category_id == 4) {
            // Treat same as category 1 (nightly booking)
            $nightStart = Carbon::parse($service->booking_start);
            $nightEnd = Carbon::parse($service->booking_end);

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
        else {
            // Default fallback to service type booking_type
            if ($service->types->booking_type === 'hourly') {
                $interval = $service->types->booking_time; // 1 hour intervals
                $current = $startTime->copy();

                while ($current <= $endTime) {
                    $slotEnd = $current->copy()->addHours($interval);
                    $isAvailable = $this->isSlotAvailable($current, $slotEnd, $bookedSlots);

                    $slots[] = [
                        'start' => $current->format('H:i'),
                        'end' => $slotEnd->format('H:i'),
                        'available' => $isAvailable
                    ];

                    $current->addHours($interval);
                }
            } elseif ($service->types->booking_type === 'daily') {
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
            } elseif ($service->types->booking_type === 'nightly') {
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
        }

        // Get all booked dates for the service
        $allBookedDates = Booking::where('service_id', $serviceId)
            ->where('status', 'APPROVED')
            ->get(['from', 'to']);

        // Get all booked slots for the service
        $allBookedSlots = Booking::where('service_id', $serviceId)
            ->where('status', 'APPROVED')
            ->get(['check_in', 'check_out']);

        if (empty($slots)) {
            $startTime = Carbon::createFromTimeString($service->booking_start);
            $endTime = Carbon::createFromTimeString($service->booking_end);
            if ($service->types->booking_type === 'hourly') {
                $interval = $service->types->booking_time; // 1 hour intervals
                $current = $startTime->copy();

                while ($current <= $endTime) {
                    $slotEnd = $current->copy()->addHours($interval);

                    $slots[] = [
                        'start' => $current->format('H:i'),
                        'end' => $slotEnd->format('H:i'),
                        'available' => true
                    ];

                    $current->addHours($interval);
                }
            } 
            elseif ($service->types->booking_type === 'daily') {
                $slots[] = [
                    'start' => '00:00',
                    'end' => '23:59',
                    'available' => true
                ];
            }
             elseif ($service->types->booking_type === 'nightly') {
                $nightStart = Carbon::parse($service->night_start);
                $nightEnd = Carbon::parse($service->night_end);

                $slots[] = [
                    'start' => $nightStart->format('H:i'),
                    'end' => $nightEnd->format('H:i'),
                    'available' => true
                ];
            }
        }
        return response()->json([
            'interval' => $service->types->booking_time,
            'availableSlots' => $slots,
            'bookedDates' => $allBookedDates,
            'bookedSlots' => $allBookedSlots,
        ]);
    }



    public function edit($id)
    {
        $booking = booking::where('id', '=', $id)->with('service', 'user')->first();
        $services = service::all();
        $users = User::all();
        return view('booking.edit', ['booking' => $booking, 'services' => $services, 'users' => $users]);
    }

    public function update(Request $request, $id)
    {
        $booking = booking::where('id', '=', $id)->first();

        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
            'user_id' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);

        if ($validator->passes()) {
            $booking->service_id = $request->service_id;
            $booking->user_id = $request->user_id;
            $booking->from = $request->from;
            $booking->to = $request->to;
            $booking->save();
            return redirect()->route('booking.index')->with('success', 'Booking edited successfully');
        } else {
            return redirect()->route('booking.edit', $id)->withInput()->withErrors($validator);
        }
    }

    public function destroy($id)
    {
        $booking = booking::find($id);
        $booking->delete();
        return redirect()->route('booking.index')->with('success', 'Booking deleted successfully');
    }

public function updateAvailability(Request $request)  {
    $booking = booking::where('id', '=', $request->booking_id)->first();

    if($request->availability == 'available'){
            $booking->status = 'APPROVED';
            $booking->to = $request->checkoutDate;
            $booking->save();
            return back()->with('success','done');
    }
    elseif($request->availability == 'not_available'){
            $booking->status = 'PENDING';
            $booking->save();
            return back()->with('success','done');
    }
    
}


}
