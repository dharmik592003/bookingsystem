<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Service;
use App\Models\type;
use App\Models\servicecategory;
use Session;
use Illuminate\Http\Request;

class ChartersController extends Controller
{
    public function index(){
        $services =  Service::where('id',4)->with('types','category')->get()->all();
        $user=User::where('id','=',Session::get('loginid'))->first();
        return view('charters.index',compact('user','services'));
            }
}
