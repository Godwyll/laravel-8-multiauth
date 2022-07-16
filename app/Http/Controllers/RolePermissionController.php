<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RolePermission;
use Session;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_permissions = RolePermission::all();
        return view('role-permissions.index', ['role_permissions' => $role_permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role_permission = RolePermission::findOrFail($id);
        return view('role-permissions.show', ['role_permission' => $role_permission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role_permission = RolePermission::findOrFail($id);
        return view('role-permissions.edit', ['role_permission' => $role_permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role_permission = RolePermission::findOrFail($id);

        $this->validate($request, [
            'role_id' => 'required',
            'permission_id' => 'required',
        ]);

        $role_permission->role_id = $request->input('role_id');
        $role_permission->permission_id = $request->input('permission_id');
        $role_permission->created_by = Auth::user()->id;

        try {
            $role_permission->save();
            Session::flash('success', 'Role Permission updated Successfully.');
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
