<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RolePermission;
use Session;
use Auth;

class RolePermissionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->can('administer-permissions')) {
            Session::flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();          
        }    

        $role_permission =  new RolePermission;

        $this->validate($request, [
            'role_id' => 'required',
            'permission_id' => 'required',
        ]);

        $role_permission->role_id = $request->input('role_id');
        $role_permission->permission_id = $request->input('permission_id');
        $role_permission->created_by = Auth::user()->id;

        try {
            $role_permission->save();
            Session::flash('success', 'Role Permission created Successfully.');
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        if (!Auth::user()->can('administer-permissions')) {
            Session::flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();          
        }    

        try {
            RolePermission::destroy($id);
            Session::flash('success', 'Role Permission deleted Successfully.');
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }
    }
}
