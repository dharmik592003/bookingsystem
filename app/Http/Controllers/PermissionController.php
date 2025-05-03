<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
 use Illuminate\Routing\Controllers\Middleware;
class PermissionController extends Controller  implements HasMiddleware
{

     public static function middleware():array{
         return [
             new Middleware('permission:permission view',['index']),
             new Middleware('permission:permission Edit',['edit']),
             new Middleware('permission:permission Create',['create']),
            new Middleware('permission:permission Delete',['delete']),
        ];
        }

    // show permission page
    public function index()
    {
        $permissions = Permission::all();
        $user = User::where('id', '=', Session::get('loginid'))->first();
        return view('permission.list', ['permissions' => $permissions,'user'=>$user]);
    }

    // create permission
    public function create()
    {        $user = User::where('id', '=', Session::get('loginid'))->first();

        return view('permission.create',['user'=>$user]);
    }

    // store permission in db
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3'
        ]);

        if ($validator->passes()) {

            Permission::create(
                [
                    'name' => $request->name,
                    'group_name' => $request->group_name,
                    'group_by' => $request->group_by
                ]
            );
            return redirect()->route('permission')->with('success', 'permission added successfully');
        } else {
            return redirect()->route('permission.store')->withInput()->withErrors($validator);
        }

    }

    // edit permission in db
    public function edit($id)
    {
        $user = User::where('id', '=', Session::get('loginid'))->first();

        $permission = Permission::where('id', '=', $id)->first();
        return view('permission.edit', ['permission' => $permission,'user'=>$user]);

    }
    // update permission in db
    public function update(Request $request, $id)
    {
        $permission = Permission::where('id', '=', $id)->first();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'group_name' => 'required'
        ]);

        if ($validator->passes()) {
            $permission->name = $request->name;
            $permission->group_name = $request->group_name;
            $permission->group_by = $request->group_by;
            $permission->save();
            return redirect()->route('permission')->with('success', 'permission edited successfully');
        } else {
            return redirect()->route('permission.create')->withInput()->withErrors($validator);
        }

    }
    // delete permission in db
    public function destroy($id)
    {
        $permission = Permission::find($id,'id');
        $permission->delete();
        return redirect()->route('permission')->with('success','permission deleted successfully');
    }
}
