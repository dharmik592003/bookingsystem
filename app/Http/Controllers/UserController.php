<?php

namespace App\Http\Controllers;
use App\Models\agency;
use App\Models\booking;
use App\Models\service;
use App\Models\User;
use App\Models\Countriy;
use App\Models\city;
use App\Models\state;
use App\Models\servicecategory;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if (!Session::has('loginid')) {
            Auth::loginUsingId(3);
            Session::put('loginid', 3);
            Session::put('customer_id', 2);
            $user = User::find(Session::get('loginid'));
            return view('user.dashboard', ['user' => $user]);
        }


        $serviceCount = service::count();
        $services = service::all();
        $userCount = User::where('role', '!=', '1')->count();

        if (Auth::check()) {
            $user = User::where('id', Session::get('loginid'))->first();
            $agency = agency::where('user_id', '=', $user->id)->first();
            $bookingCounts = booking::where('status', '=', 'pending')->count();

            if ($user->id == 1) {
                $states = User::with('state', 'city', 'country')->get();
                return view('admin.dashboard', [
                    'total' => $serviceCount,
                    'user' => $user,
                    'services' => $services,
                    'states' => $states,
                    'bookingcount' => $bookingCounts,
                    'usercount' => $userCount
                ]);
            } elseif (Session::get('customer_id') == 2) {
                $catservices = servicecategory::with('getservices')->get()->all();
                $cart = Session::get('cart');
                if (!$cart) {
                    session()->put('cart', []);
                }
                return view('user.dashboard', ['user' => $user, "services" => $catservices]);
            } elseif (Session::get('customer_id') == 3) {
                $usercount = booking::where('agency_id', Session::get('agency_id'))->count();
                return view('agency.dashboard', ['user' => $user, 'agency' => $agency, 'usercount' => $usercount]);
            }
        }
    }


    public function getstates(Request $request)
    {

        $states = state::where('country_id', $request->id)->get();

        if ($states) {
            return response()->json(['id' => $states]);

        }
        $data = $states;
        // dd($states);->with($data)
        dd($data);
        return view('student')->with($data);
    }


    public function getcity(Request $request)
    {
        $city = city::where('state_id', $request->id)->get();

        if ($city) {
            return response()->json(['id' => $city]);

        }
        $data = $city;
        // dd($states);->with($data)
        dd($data);
        return view('student')->with($data);
    }

    public function Store(Request $request)
    {
        $user = new User();
        $request->validate([
            "name" => 'required ',
            "email" => 'required | email |unique:Users',
            "password" => 'required',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->number = $request->phone;
        $user->address = $request->address;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();
    }

    public function profile()
    {
        if (Auth::check()) {
            $user = User::with(['state', 'city', 'agencytypeuser'])->find(Session::get('loginid'));
            if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
            }

            if (Session::get('customer_id') == 3) {
            $agency = agency::where('user_id', $user->id)->first();

            if (!$agency) {
                return redirect()->back()->with('error', 'Agency details not found.');
            }

            return view('auth.profile', ['user' => $user, 'agency' => $agency]);
            } elseif (Session::get('customer_id') == 2) {

            return view('auth.profile', ['user' => $user]);
            } elseif (Session::get('customer_id') == 1) {

            return view('auth.profile', ['user' => $user]);
            }
        }

        return redirect()->route('login')->with('error', 'Please login to view your profile.');
    }

public function editprofile(Request $request,$id)
{
    $user = User::find($id);
    if ($user) {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->number = $request->phone;
        $user->address = $request->address;

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = 'userprofile/' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('userprofile/'), $filename);
            $user->profile_photo = $filename;
        }

        if ($user->role == 3 && $user->agency) {
            $agency = $user->agency;
            $agency->name = $request->agencyname;
            $agency->state_id = $request->state_id;
            $agency->city_id = $request->city_id;
            $agency->save();
        }

        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    return redirect()->back()->with('error', 'User not found.');}
}

// <div class="mt-3 flex-col ">
// <div class="row">
//     <div class="col-xl-12">
//         @foreach($permissions as $permission => $values)
//         <div class="mx-5">
//             <input type="checkbox" data-group="{{ $permission }}"
//                 class='allcheck permission' id='permission-{{ $permission}}'
//                 value="{{ $permission }}" id="">

//             <label for="permision">{{ $permission }}:</label>
//             <div class="row">
//                 <div class="col-xl-6 ">
//                     <div class="mx-5 d-flex flex-column justify-content-between">
//                         @foreach ($values as $value => $val)
//                         <div class="">
//                             <input {{ ($hasPermissions->contains($val->name))? 'checked': ''
//                             }} type="checkbox" class='permission'

//                             id='permission-{{ $val->id}}' data-group="{{ $val->group_name}}"
//                             value="{{ $val->name }}"
//                             name="permission[]" id="">
//                             <label for="permision">{{ $val->name }}</label>
//                         </div>
//                         @endforeach
//                     </div>
//                 </div>

//             </div>
//         </div>
//         @endforeach
//     </div>
// </div>
// </div>