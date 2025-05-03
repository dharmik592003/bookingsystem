<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\agency;
use App\Models\country;
use Illuminate\Http\Request;
use Session;
use Hash;
use Spatie\Permission\Models\Role;

class RegistraionController extends Controller 
{


    public function index()
    {
        $country = country::where('id', '=', '102')->get();
        return view('auth.RegistrationForm', ['country' => $country]);
    }
    public function user(Request $request)
    {

        $request->validate([
            "name" => 'required ',
            "email" => 'required | email |unique:Users',
            "phone" => 'required |max:11',
            "password" => 'required',
        ]);
        if ($request->role == 2) {
            
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->number =  $request->phone;

            $user->role = $request->role;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->syncRoles(3);
            Session::put('loginid', $user->id);
            Session::put('customer_id', $user->role);
            return redirect('/')->with('success', 'Logged in as user');
        } elseif ($request->role == 3) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->number =  $request->phone;


            $user->role = $request->role;
            $user->password = Hash::make($request->password);
            $user->save();
            $agency = new agency();
            $agency->name = $request->agencyname;
            $agency->user_id = $user->id;
            $agency->country_id = $request->country_id;
            $agency->state_id = $request->state_id;
            $agency->city_id = $request->city_id;
            $agency->save();
            $user->syncRoles(8);

            Session::put('loginid', $user->id);
            Session::put('customer_id', $user->role);
            Session::put('agency_id', $agency->id);
            return redirect('/')->with('success', 'Logged in as agency');
        }

    }
    public function addagency(Request $request)
    {
        $user = new User();
        $request->validate([
            "name" => 'required ',
            "email" => 'required | email |unique:Users',
            "password" => 'required',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->number =  $request->phone;


        $user->role = $request->role;


        $user->password = Hash::make($request->password);
        $user->save();
        if ($request->role == 3) {
            $agency = new agency();
            $agency->name = $request->agencyname;
            $agency->user_id = $user->id;
            $agency->country_id = $request->country_id;
            $agency->state_id = $request->state_id;
            $agency->city_id = $request->city_id;
            $agency->save();
        }

        return back();
    }
}
