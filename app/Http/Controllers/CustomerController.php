<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\booking;
use Illuminate\Http\Request;
use Session;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class CustomerController extends Controller  implements HasMiddleware
{
    public static function middleware(): array {
        return [
            new Middleware('permission:User View',  ['index']),
            new Middleware('permission:User Edit',  ['edit']),
            new Middleware('permission:User Create',  ['create']),
            new Middleware('permission:User Delete',  ['delete']),
        ];
    }

    public function index()
    {

        if(Session::get('loginid')==1){
        $usercount = User::where('role', '=', '2')->count();
        $users = User::where('role', '=', '2')->get();
        $agent = User::where('id', '=', Session::get('loginid'))->first();
        return view('user.list', ['usercount' => $usercount, 'customers' => $users, 'user' => $agent]);}
        if(Session::get('customer_id')==3){
            $agent = User::where('id', '=', Session::get('loginid'))->first();
            
            $users = booking::where('agency_id', '=', $agent->id)->with('customer')->get('user_id')->all();
        $usercount = booking::where('agency_id', '=', $agent->id)->count();
        return view('user.list', ['usercount' => $usercount, 'customers' => $users, 'user' => $agent]);}

    }



public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',
    ]);

    $user = new User();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->role = 2;
    $user->save();
    return redirect()->route('user.index')->with('success', 'Customer created successfully.');
}

public function edit($id)
{
    $user = User::find($id);
    $agent = User::where('id', '=', Session::get('loginid'))->first();
    return view('user.Customeredit', ['user' => $user, 'agent' => $agent]);
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'phone' => 'required',
        'address' => 'required',
    ]);

    $user = User::find($id);
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->phone = $request->input('phone');
    $user->address = $request->input('address');
    $user->save();

    return redirect()->route('user.index')->with('success', 'Customer updated successfully.');
}

public function destroy($id)
{
    $user = User::find($id);
    $user->delete();
    return redirect()->route('customer')->with('success', 'Customer deleted successfully.');
}
}
