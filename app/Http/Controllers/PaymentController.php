<?php

namespace App\Http\Controllers;
use App\Models\charter;
use App\Models\yacht;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\booking;
use App\Models\type;
use App\Models\stay;
use App\Models\car;
use App\Models\port;
use App\Mail\OtpMail;
use Illuminate\Support\Carbon;
use App\Models\Payment;
use App\Models\User;
use App\Models\Invoice;
use App\Models\airport;
use phpDocumentor\Reflection\Types\Integer;
use Session;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function conformbooking(Request $request, $cat_id, $ser_id, $typeid, $subser_id)
    {
        $ports = port::all();
        $airports = airport::all();
        $categoryId = ServiceCategory::where('id', '=', $cat_id)->first();
        $user = User::where('id', '=', Session::get('loginid'))->first();
        if ($categoryId->id == 1) {

            $services = Service::where('category_id', '=', $categoryId->id)->where('id', '=', $ser_id)
                ->with(['category', 'agency.city', 'agency.state', 'agency.country', 'types'])
                ->first();
            $agency_id = Service::where('name', '=', $ser_id)->pluck('agency_id');
            $stay = Stay::where('id', $subser_id)->first();

            return view('conform.conformBooking', ['stay' => $stay, 'services' => $services, 'user' => $user]);
        }
        if ($categoryId->id == 2) {

            $services = Service::where('category_id', '=', $categoryId->id)->where('id', '=', $ser_id)
                ->with(['category', 'agency.city', 'agency.state', 'agency.country', 'types'])
                ->first();
            $agency_id = Service::where('name', '=', $ser_id)->pluck('agency_id');
            $stay = car::where('id', $subser_id)->first();

            return view('conform.conformBooking', ['stay' => $stay, 'services' => $services, 'user' => $user]);
        }
        if ($categoryId->id == 3) {

            $services = Service::where('category_id', '=', $categoryId->id)->where('id', '=', $ser_id)
                ->with(['category', 'agency.city', 'agency.state', 'agency.country', 'types'])
                ->first();
            $agency_id = Service::where('name', '=', $ser_id)->pluck('agency_id');
            $stay = yacht::where('id', $subser_id)->first();

            return view('conform.conformBooking', ['stay' => $stay, 'services' => $services, 'user' => $user, 'ports' => $ports]);
        }
        if ($categoryId->id == 4) {
            $services = Service::where('category_id', '=', $categoryId->id)->where('id', '=', $ser_id)
                ->with(['category', 'agency.city', 'agency.state', 'agency.country', 'types'])
                ->first();
            $agency_id = Service::where('name', '=', $ser_id)->pluck('agency_id');
            $stay = charter::where('id', $subser_id)->first();

            return view('conform.conformBooking', ['stay' => $stay, 'services' => $services, 'user' => $user,'ports' => $airports]);
        } else {
            $services = [];
        }
    }
    public function index(Request $request, $cat_id, $ser_id, $typeid, $subser_id)
    {


        $servicetypecharge = type::where('id', '=', $typeid)->first();
        $startDateTime = Carbon::parse($request->input('from') . ' ' . $request->input('checkin_time'));

        $endDateTime = Carbon::parse($request->input('to') . ' ' . $request->input('checkout_time'));
        if ($cat_id == 1) {
            $stay = stay::where('id', $subser_id)->first();
            $type = type::where('id', $typeid)->get()->first();
            $booking = new booking();
            $booking->service_id = $ser_id;
            $booking->user_id = Session::get('loginid');
            $isbooked = booking::where('service_id', '=', $ser_id)->where('Stay_id', $subser_id)->whereDate('from', '<=', $request->from)->whereDate('to', '>=', $request->to)->whereTime('check_in', '<=', $request->checkin_time)->whereTime('check_out', '>=', $request->checkout_time)->where('status', '=', 'APPROVED')->get();
            $booking->agency_id = service::where('id', '=', $ser_id)->get('agency_id')->value('agency_id');
            $booking->user_id = Session::get('loginid');
            if (blank($isbooked)) {
                $booking->type_id = $typeid;
                $booking->from = $request->from;
                $booking->to = $request->to;
                $booking->Stay_id = $subser_id;
                $booking->adults = $request->adults;
                $booking->children = $request->children;
                $booking->pets = $request->pets;
                $booking->check_in = $request->checkin_time;
                $booking->check_out = $request->checkout_time;
                $booking->discount = $stay->Discount || 4;
                $booking->save();
                Session::put('booking_id', $booking->id);
            }
            // Hotel/Villa
            $days = round($startDateTime->diffInDays($endDateTime));
            $totalHours = $days * 24;
            $bill = $days * $servicetypecharge->price;
            $bill = $bill - ($stay->Discount) / 100;
            $user = User::where('id', '=', Session::get('loginid'))->first();

            $services = stay::where('id', '=', $subser_id)->with('type')->get();
            Session::put('info', array_merge($request->all(), ['category_id' => $cat_id, 'service_id' => $ser_id, 'type_id' => $typeid]));
            Session::put('bill', $bill);

            $info = $request->all();
            $invoice = Invoice::create([
                'booking_id' =>  Session::get('booking_id'),
                              
                'user_id' => Session::get('loginid'),
                'service_id' => $ser_id,
                'type_id' => $typeid,
                'bill' => $bill,
                'days' => $days,
                'total_hours' => $totalHours,
                'discount' => $stay->Discount,
                'additional_info' => json_encode($request->all()),
            ]);
            return view('payments.index', compact('days', 'bill', 'services', 'info', 'user','totalHours'));
        } 
        
        elseif ($cat_id == 2) { // cars
            $cars = car::where('id', $subser_id)->first();
            $type = type::where('id', $typeid)->get()->first();
            $booking = new booking();
            $booking->service_id = $ser_id;
            $booking->user_id = Session::get('loginid');
            $isbooked = booking::where('service_id', '=', $ser_id)->whereDate('from', '<=', $request->from)->whereDate('to', '>=', $request->to)->whereTime('check_in', '<=', $request->checkin_time)->whereTime('check_out', '>=', $request->checkout_time)->where('status', '=', 'APPROVED')->get();
            $booking->agency_id = service::where('id', '=', $ser_id)->get('agency_id')->value('agency_id');
            
                 $booking->user_id = Session::get('loginid');
            if (blank($isbooked)) {
            $booking->type_id = $typeid;
            $booking->from = $request->from;
            $booking->to = $request->to;
            $booking->car_id = $subser_id;
            $booking->with_driver = $request->driver || 0;
            $booking->long_trip = $request->longtrip || 0;
            $booking->daily_ride = $request->dailyride || 0;
            $booking->check_in = $request->checkin_time;
            $booking->check_out = $request->checkout_time;
            $booking->discount = $cars->Discount || 4;
            $booking->save();
            Session::put('booking_id', $booking->id);
            }
            $startDateTime = Carbon::parse($request->input('from') . ' ' . $request->input('checkin_time'));
            $endDateTime = Carbon::parse($request->input('to') . ' ' . $request->input('checkout_time'));
            $totalHours = $startDateTime->diffInHours($endDateTime);

            if ($request->dailyride == 1) {
            $user = User::where('id', '=', Session::get('loginid'))->first();
            $services = car::where('id', '=', $subser_id)->with('type')->get();

            $type = Type::where('id', $typeid)->first();
            $booking = booking::where('id', Session::get('booking_id'))->first();
            $hours = $totalHours;
            $days = ceil($startDateTime->diffInDays($endDateTime));
            $bill = $hours * $type->price ;

            if ($request->driver == 1) {
                $bill = $bill + $type->pilot_price;
            }
            $bill = $bill - ($cars->Discount) / 100;

            Session::put('info', array_merge($request->all(), ['category_id' => $cat_id, 'service_id' => $ser_id, 'type_id' => $typeid]));
            Session::put('bill', $bill);

            $info = $request->all();
            $invoice = Invoice::create([
                'booking_id' => Session::get('booking_id'),
                               
                'user_id' => Session::get('loginid'),
                'service_id' => $ser_id,
                'type_id' => $typeid,
                'bill' => $bill,
                'days' => $days,
                'total_hours' => $totalHours,
                'discount' => $cars->Discount,
                'additional_info' => json_encode($request->all()),
            ]);
            return view('payments.index', compact('days', 'booking', 'bill', 'services', 'info', 'user', 'totalHours'));
            }
            if ($request->dailyride == 0) {
            $days = ceil($startDateTime->diffInDays($endDateTime));
            $bills = $days * $type->price;

            $bill = $bills + $type->pilot_price + $type->fuel_cost;
            $booking = booking::where('id', Session::get('booking_id'))->first();
            $user = User::where('id', '=', Session::get('loginid'))->first();

            $services = car::where('id', '=', $subser_id)->with('type')->get();

            $type = Type::where('id', $typeid)->first();

            if ($request->driver == 1) {
                $days = ceil($startDateTime->diffInDays($endDateTime));
                $bills = $totalHours * $type->price;
                $bill = $bills + $type->pilot_price + $type->fuel_cost;
                $bill = $bill - ($cars->Discount) / 100;
                Session::put('info', array_merge($request->all(), ['category_id' => $cat_id, 'service_id' => $ser_id, 'type_id' => $typeid]));
                Session::put('bill', $bill);

                $info = $request->all();
                $invoice = Invoice::create([
                    'booking_id' => Session::get('booking_id'),
                                   
                'user_id' => Session::get('loginid'),
                    'service_id' => $ser_id,
                    'type_id' => $typeid,
                    'bill' => $bill,
                    'days' => $days,
                    'total_hours' => $totalHours,
                    'discount' => $cars->Discount,
                    'additional_info' => json_encode($request->all()),
                ]);
                return view('payments.index', compact('days', 'booking', 'bill', 'services', 'info', 'user', 'totalHours'));
            } else {
                $days = ceil($startDateTime->diffInDays($endDateTime));
                $bill = $totalHours * $type->price;
                $user = User::where('id', '=', Session::get('loginid'))->first();

                $services = car::where('id', '=', $subser_id)->with('type')->get();

                Session::put('info', array_merge($request->all(), ['category_id' => $cat_id, 'service_id' => $ser_id, 'type_id' => $typeid]));
                Session::put('bill', $bill);

                $info = $request->all();
                $bill = $bill - ($cars->Discount) / 100;
                $invoice = Invoice::create([
                    'booking_id' => Session::get('booking_id'),
                                   
                'user_id' => Session::get('loginid'),
                    'service_id' => $ser_id,
                    'type_id' => $typeid,
                    'bill' => $bill,
                    'days' => $days,
                    'total_hours' => $totalHours,
                    'discount' => $cars->Discount,
                    'additional_info' => json_encode($request->all()),
                ]);
                return view('payments.index', compact('days', 'bill', 'services', 'info', 'user', 'totalHours'));
            }
            }
        
        } elseif ($cat_id == 3) { // Yacht

            $yacht = yacht::find($subser_id);
            $type = type::find($typeid);
            $booking = new booking();

            // Check if already booked
            $isbooked = booking::where('service_id', $ser_id)
            ->whereDate('from', '<=', $request->from)
            ->whereDate('to', '>=', $request->to)
            ->whereTime('check_in', '<=', $request->checkin_time)
            ->whereTime('check_out', '>=', $request->checkout_time)
            ->where('status', 'APPROVED')->get();

            $booking->agency_id = service::where('id', $ser_id)->value('agency_id');
            $booking->user_id = Session::get('loginid');

            if (blank($isbooked)) {
            // Store booking info
            $booking->type_id = $typeid;
            $booking->service_id = $ser_id;
            $booking->from = $request->from;
            $booking->to = $request->to;
            $booking->adults = $request->adults;
            $booking->children = $request->children;
            $booking->pets = $request->pets;
            $booking->Yacht_id = $subser_id;
            $booking->Departure = $request->Departure;
            $booking->Arrival = $request->Arrival;
            $booking->check_in = $request->checkin_time;
            $booking->check_out = $request->checkout_time;
            $booking->discount = $type->discount ?? 4;
            $booking->save();

            Session::put('booking_id', $booking->id);
            }

            // Duration and billing calculation
            $startDateTime = Carbon::parse($request->from . ' ' . $request->checkin_time);
            $endDateTime = Carbon::parse($request->to . ' ' . $request->checkout_time);

            // Calculate total hours
            $totalHours = $startDateTime->diffInHours($endDateTime);
            $bill = $totalHours * ($type->price ?? 0);

            // Apply discount
            if ($yacht && $yacht->Discount) {
            $bill = $bill - ($bill * $yacht->Discount / 100);
            }

            // Prepare data for view
            $user = User::find(Session::get('loginid'));
            $services = yacht::where('id', $subser_id)->with('type')->get();

            Session::put('info', array_merge($request->all(), [
            'category_id' => $cat_id,
            'service_id' => $ser_id,
            'type_id' => $typeid,
            ]));
            Session::put('bill', $bill);
if(round($totalHours) > 24){
$days =round($totalHours / 24) + 1 ;};
            $info = $request->all();
            $invoice = Invoice::create([
                'booking_id' => Session::get('booking_id'),         
                'user_id' => Session::get('loginid'),
                'service_id' => $ser_id,
                'type_id' => $typeid,
                'bill' => $bill,
                'days' => $days,
                'total_hours' => $totalHours,
                'discount' => $yacht->Discount,
                'additional_info' => json_encode($request->all()),
            ]);
                return view('payments.index', compact('bill', 'services', 'info', 'user'))->with('totalHours', $totalHours);
        } 
        elseif ($cat_id == 4) { // charter
            $charter = charter::where('id', $subser_id)->first();
            $type = type::where('id', $typeid)->get()->first();
            $booking = new booking();
            $booking->service_id = $ser_id;
            $booking->user_id = Session::get('loginid');
            $isbooked = booking::where('service_id', '=', $ser_id)
            ->whereDate('from', '<=', $request->from)
            ->whereDate('to', '>=', $request->to)
            ->whereTime('check_in', '<=', $request->checkin_time)
            ->whereTime('check_out', '>=', $request->checkout_time)
            ->where('status', '=', 'APPROVED')->get();
            $booking->agency_id = service::where('id', '=', $ser_id)->get('agency_id')->value('agency_id');
            
                 $booking->user_id = Session::get('loginid');
            if (blank($isbooked)) {
            $booking->type_id = $typeid;
            $booking->from = $request->from;
            $booking->to = $request->to;
            $booking->adults = $request->adults;
            $booking->children = $request->children;
            $booking->pets = $request->pets;
            $booking->Charter_id = $subser_id;
            $booking->Departure = $request->Departure;
            $booking->Arrival = $request->Arrival;
            $booking->check_in = $request->checkin_time;
            $booking->check_out = $request->checkout_time;
            $booking->discount = $type->discount || 4;
            $booking->save();
            Session::put('booking_id', $booking->id);
            }

            $startDateTime = Carbon::parse($request->from . ' ' . $request->checkin_time);
            $endDateTime = Carbon::parse($request->to . ' ' . $request->checkout_time);
            $totalHours = $startDateTime->diffInHours($endDateTime);

            if ($request->input('rental_type') == 'hourly') {
            $hours = $totalHours;
            $days = ceil($totalHours / 24);
            $bill = $hours * $request->input('price');
            $bill = $bill - ($charter->Discount / 100);
            $user = User::where('id', '=', Session::get('loginid'))->first();

            $services = charter::where('id', '=', $subser_id)->with('type')->get();
            Session::put('info', array_merge($request->all(), ['category_id' => $cat_id, 'service_id' => $ser_id, 'type_id' => $typeid]));
            Session::put('bill', $bill);

            $info = $request->all();
            $invoice = Invoice::create([
                'booking_id' => Session::get('booking_id'),
                'user_id' => Session::get('loginid'),
                'service_id' => $ser_id,
                'type_id' => $typeid,
                'bill' => $bill,
                'days' => $days,
                'total_hours' => $totalHours,
                'discount' => $charter->Discount,
                'additional_info' => json_encode($request->all()),
            ]);
            return view('payments.index', compact('days', 'bill', 'services', 'info', 'user', 'totalHours'));
            } 
            else {
            $distance = $request->input('distance');
            $days = ceil($totalHours / 24);
            $bill = ($distance * $servicetypecharge->price) + ($days * $servicetypecharge->price);
            $bill = $bill - ($charter->Discount / 100);
            $user = User::where('id', '=', Session::get('loginid'))->first();

            $services = charter::where('id', '=', $subser_id)->with('type')->get();
            Session::put('info', array_merge($request->all(), ['category_id' => $cat_id, 'service_id' => $ser_id, 'type_id' => $typeid]));
            Session::put('bill', $bill);

            $info = $request->all();
            $invoice = Invoice::create([
                'booking_id' => Session::get('booking_id'),
                'user_id' => Session::get('loginid'),
                'service_id' => $ser_id,
                'type_id' => $typeid,
                'bill' => $bill,
                'days' => $days,
                'total_hours' => $totalHours,
                'discount' => $charter->Discount,
                'additional_info' => json_encode($request->all()),
            ]);
            return view('payments.index', compact('days', 'bill', 'services', 'info', 'user', 'totalHours'));
            }
        }
        }

    





    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);


        $otp = rand(100000, 999999);
        $payment = new payment();
        $payment->booking_id = Session::get('booking_id');
        $payment->value = Session::get('bill');
        $payment->description = json_encode($request->desc);
        $payment->OTP = $otp;

        $payment->save();
        Session::put('Payment_id', $payment->id);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found', 'status' => 'Fail'], 404);
        }




        try {
            Mail::to($user->email)->send(new OtpMail(
                "Your OTP is: $otp",
                "OTP Verification"
            ));
            return response()->json([
                'message' => 'OTP sent successfully',
                'status' => 'Success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to send OTP: ' . $e->getMessage(),
                'status' => 'Fail'
            ], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric'
        ]);

        $Payment = payment::where('id', Session::get('Payment_id'))
            ->where('otp', $request->otp)
            ->first();
        if ($Payment) {
            $Payment->OTP = null; // Clear OTP after successful verification
            $Payment->save();


            return response()->json([
                'message' => 'OTP verified successfully',
                'status' => 'Success'
            ]);
        }

        return response()->json([
            'message' => 'Invalid OTP',
            'status' => 'Fail'
        ], 422);
    }



}
