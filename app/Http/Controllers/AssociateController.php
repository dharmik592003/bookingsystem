<?php

namespace App\Http\Controllers;
use App\Models\Agency;
use Validator;
use App\Models\User;
use Session;
use Illuminate\Http\Request;
use App\Models\Associate;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;


 
class AssociateController extends Controller  implements HasMiddleware
{
     public static function middleware(): array {
         return [
            new Middleware('permission:Associate View',  ['index']),
            new Middleware('permission:Associate Edit',  ['edit']),
            new Middleware('permission:Associate Create',  ['create']),
            new Middleware('permission:Associate Delete',  ['delete']),
        ];
    }

    public function index()
    {
        $Associate = Associate::where('agency_id', '=', Session::get('agency_id'))->with('user')->get()->all();
        if (empty($Associate)) {
            $user = User::where('id', '=', Session::get('loginid'))->first();
            if (!$user) {
                return redirect()->route('Associate.index')->with('error', 'User not found.');
            }
            $customer = User::where('Role', '=', '2')->get()->all();
            $permission = Permission::all();
            return view('Associate.index', ['customers' => $customer, 'user' => $user, 'Accociates' => $Associate]);
        } else {
            $user = User::where('id', '=', Session::get('loginid'))->first();
            $customer = User::where('Role', '=', '2')->get()->all();


            $permission = Permission::all();
            return view('Associate.index', ['permissions' => $permission, 'customers' => $customer, 'user' => $user, 'Accociates' => $Associate]);
        }
    }

    //find Associate
    public function getAssociate()
    {
        $Associate = Associate::where('agency_id', '=', Session::get('agency_id'))->get()->all();
        return $Associate;
    }
    // create Associate
    public function store(Request $request)
    {
        $User_id = User::where('email', '=', $request->email)->get('id')->value('id');
        $validator = Validator::make($request->all(), [
            'email' => 'required'
        ]);
        $Asscoiatevalid = Associate::where('user_id', '=', $User_id)->exists();
        if (!$Asscoiatevalid) {
            if ($validator->passes()) { {
                    $Asscoaite = new Associate();

                    $Asscoaite->user_id = User::where('email', '=', $request->email)->get('id')->value('id');
                    $Asscoaite->agency_id = Session::get('agency_id');
                    $Asscoaite->save();

                    return redirect()->route('Associate.index')->with('success', 'Associate added successfully');
                }
            } elseif ($validator->failed()) {
                return redirect()->route('Associate.index')->withInput()->withErrors($validator);
            }
        } elseif ($Asscoiatevalid) {
            return redirect()->route('Associate.index')->withInput()->withErrors('already in other agency');
        }
    }







    // edit Associate in db
    public function edit($id)
    {
        $userid = Associate::where('id', '=', $id)->get('user_id')->value('user_id');
        $user = User::where('id', '=', $userid)->first();
        $Roles = Role::all();
        $Associate = Associate::where('id', '=', $id)->with('user')->first();
        $hasRoles = $user->roles->pluck('name');
        return view('Associate.edit', ['Associate' => $Associate, 'Roles' => $Roles, 'hasRoles' => $hasRoles, 'user' => $user]);

    }
    // update Associate in db
    public function update(Request $request, $id)
    {
        $userid = Associate::where('id', '=', $id)->get('user_id')->value('user_id');
        $user = User::where('id', '=', $userid)->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
   
            if (!empty($request->role)) {
                $user->syncRoles($request->role);
            } else {
                $user->syncRoles([]);
            }
            return redirect()->route('Associate.index')->with('success', 'User edited successfully');
        } else {
            return redirect()->route('Associate.edit', $id)->withInput()->withErrors($validator);
        }

    }
    // delete Associate in db
    public function destroy($id)
    {
        $Associate = Associate::find($id, 'id');
        $userid = Associate::where('id', '=', $id)->get('user_id')->value('user_id');
        $user = User::where('id', '=', $userid)->first();
       
            $user->syncRoles([]);
        
        $Associate->delete();
        return redirect()->route('Associate.index')->with('success', 'Associate deleted successfully');
    }
}
