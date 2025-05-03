<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\agency;
use Illuminate\Support\Facades\Auth;

use Hash;
use Session;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.LoginPage');
    }

    public function guest_login(Request $request)
    {
        $guest_id = 'guest_'.uniqid();
        $request->session()->put('guest_id', $guest_id);
        $request->session()->put('is_guest', true);
        
        return redirect('/')->with('success', 'Logged in as guest');
    }

    public function login_user(Request $request)
    {
        $request->validate([
            "email" => 'required|email',
            "password" => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $agent = Auth::user();
            $agency = agency::where('user_id', '=', $agent->id)->first();

            $request->session()->put('loginid', $agent->id);
            $request->session()->put('customer_id', $agent->role);
            if ($agent->role == 3 || $agent->role == 1) {
                $request->session()->put('agency_id', $agency->id);
            }

            return redirect('/');
        } else {
            return back()->with('fail', 'Invalid credentials');
        }
    }


    public function logout()
    {
        Auth::logout();

        if (Session::has('loginid')) {
            Session::pull('loginid');
            Session::pull('customer_id');
            Session::pull('cart');
            Session::pull('agency_id');
        }

        // Also clear guest session if exists

        return redirect("/");
    }

    public function upgrade_guest(Request $request)
    {
        // Logic to convert guest to registered user
        // Would validate and create new user
        // Then transfer any guest session data
        
        return redirect('/')->with('success', 'Account created successfully');
    }

}
