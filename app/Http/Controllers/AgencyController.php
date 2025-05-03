<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\agency;
use App\Models\country;
use Session;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class AgencyController extends Controller implements HasMiddleware
{
     public static function middleware(): array {
         return [
             new Middleware('permission:Agency View',  ['index']),
             new Middleware('permission:Agency Edit',  ['editcustomer']),
             new Middleware('permission:Agency Create',  ['create']),
             new Middleware('permission:Agency Delete',  ['delete']),
         ];
     }

    public function index(){
        $country = country::where('id','=','102')->get();
        $user = agency::all()->count() ;
        $users = agency::with('user')->get();
        $agent = User::where('id', '=', Session::get('loginid'))->first();
            return view('agency.index',['usercount'=>$user,'users'=>$users,'user'=>$agent,'country'=>$country ]);
           }


           public function edit($id)
           {
               $details = agency::where('id', $id)->first();
               $customer = User::where('id', $details->Customer_id)->first();
               $ids = [$details, $customer];
               if ($ids) {
                   return response()->json(['details' => $details, 'customer' => $customer]);
               }
       
           }
           public function update(Request $request, $id)
           {
               $request->validate([
                   "name" => 'required ',
                   "mail" => 'required | email ',
                   "password" => 'required',
                   "number" => 'required | min:11',
                   "address" => 'required',
                   "category" => 'required',
                   "products" => 'required',
               ]);
               $customer = User::where('id', $id)->first();
               $customer->name = $request->name;
               $customer->mail = $request->mail;
               $customer->save();
               $cat = agency::where('id', $id)->first();
               $cat->Product_id = $request->products;
               $cat->Customer_id = $customer->id;
               $cat->Category_id = $request->category;
               $cat->save();
               return back();
           }
           public function destroy($id){
                $user = agency::where('id', $id)->first();
                $user->delete();
                return back();
           }
}
