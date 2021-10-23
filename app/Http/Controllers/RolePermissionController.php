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
            'user_id' => 'required',
            'role_id' => 'required',
            'permission_id' => 'required',
        ]);

        $role_permission->user_id = $request->input('user_id');
        $role_permission->role_id = $request->input('role_id');
        $role_permission->permission_id = $request->input('permission_id');
        $role_permission->added_by = Auth::user()->id;

        if($role_permission->save()){
            Session::flash('success', 'Role Permission created Successfully.');
            return redirect()->back();
        }else{
            Session::flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RolePermission  $role_permission
     * @return \Illuminate\Http\Response
     */
    public function show(RolePermission $role_permission)
    {
        $role_permission = RolePermission::findOrFail($role_permission);
        return view('role-permissions.show', ['role_permission' => $role_permission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RolePermission  $role_permission
     * @return \Illuminate\Http\Response
     */
    public function edit(RolePermission $role_permission)
    {
        $role_permission = RolePermission::findOrFail($role_permission);
        return view('role-permissions.edit', ['role_permission' => $role_permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RolePermission  $role_permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RolePermission $role_permission)
    {
        $role_permission = RolePermission::findOrFail($role_permission);

        $this->validate($request, [
            'user_id' => 'required',
            'role_id' => 'required',
            'permission_id' => 'required',
        ]);

        $role_permission->user_id = $request->input('user_id');
        $role_permission->role_id = $request->input('role_id');
        $role_permission->permission_id = $request->input('permission_id');
        $role_permission->added_by = Auth::user()->id;

        if($role_permission->save()){
            Session::flash('success', 'Role Permission updated Successfully.');
            return redirect()->back();
        }else{
            Session::flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RolePermission  $role_permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(RolePermission $role_permission)
    {
        $role_permission = RolePermission::destroy($role_permission);

        if($role_permission){
            Session::flash('success', 'Role Permission deleted Successfully.');
            return redirect()->back();
        }else{
            Session::flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }

    }
}