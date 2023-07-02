<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RolePermission;

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
        if (!auth()->user()->can('administer-permissions')) {
            session()->flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();
        }

        $role_permission =  new RolePermission;

        $this->validate($request, [
            'role_id' => 'required',
            'permission_id' => 'required',
        ]);

        $role_permission->role_id = $request->input('role_id');
        $role_permission->permission_id = $request->input('permission_id');
        $role_permission->created_by = auth()->user()->id;

        try {
            $role_permission->save();
            session()->flash('success', 'Role Permission created Successfully.');
        } catch (\Throwable $th) {
            session()->flash('error', 'Sorry, something went wrong.');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('administer-permissions')) {
            session()->flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();
        }

        try {
            RolePermission::destroy($id);
            session()->flash('success', 'Role Permission deleted Successfully.');
        } catch (\Throwable $th) {
            session()->flash('error', 'Sorry, something went wrong.');
        }
        return redirect()->back();
    }
}
