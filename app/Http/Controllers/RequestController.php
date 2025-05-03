<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

use App\Models\booking;
use App\Models\Associate;
use Session;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class RequestController extends Controller  implements HasMiddleware
{
    public static function middleware(): array {
        return [
            new Middleware('permission:Request View',  ['index']),
            new Middleware('permission:Request Edit',  ['edit']),
            new Middleware('permission:Request Create',  ['create']),
            new Middleware('permission:Request Delete',  ['delete']),
        ];
    }

    public function index()
    {
        $requests = booking::get();
        $ids = booking::with('customer', 'service')->get();
        $booking = booking::where('user_id', '=', Session::get('loginid'))->with('customer', 'service')->get();
        $user = User::where('id', '=', Session::get('loginid'))->first();
        return view('request.index', ['requests' => $requests, 'ids' => $ids, 'customers' => $booking,'user'=>$user]);
    }
    public function AssociateRequest()
    {
        $requests = Associate::get();
        $ids = Associate::with('customer', 'service')->get();
        $booking = Associate::where('user_id', '=', Session::get('loginid'))->with('customer', 'service')->get();
        $user = Associate::where('id', '=', Session::get('loginid'))->first();
        return view('services.ServiceRequests', ['requests' => $requests, 'ids' => $ids, 'users' => $booking,'user'=>$user]);
    }
}
