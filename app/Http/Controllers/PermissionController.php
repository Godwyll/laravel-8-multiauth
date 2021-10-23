<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\UserRole;
use Session;
use Auth;
use Str;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_permissions = RolePermission::all();
        $permissions = Permission::all();
        $user_roles = UserRole::all();
        $roles = Role::all();
        return view('permissions.index', ['permissions' => $permissions, 'roles' => $roles, 'role_permissions' => $role_permissions, 'user_roles' => $user_roles, 'count' => 1]);
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
        $permission =  new Permission;

        $this->validate($request, [
            'name' => 'required',
        ]);

        $permission->name = $request->input('name');
        $permission->slug = Str::slug($request->input('name'));

        if($permission->save()){
            Session::flash('success', 'Permission created Successfully.');
            return redirect()->back();
        }else{
            Session::flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        $permission = Permission::findOrFail($permission);
        return view('permissions.show', ['permission' => $permission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $permission = Permission::findOrFail($permission);
        return view('permissions.edit', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $permission = Permission::findOrFail($permission);

        $this->validate($request, [
            'name' => 'required',
        ]);

        $permission->name = $request->input('name');
        $permission->slug = Str::slug($request->input('name'));

        if($permission->save()){
            Session::flash('success', 'Permission updated Successfully.');
            return redirect()->back();
        }else{
            Session::flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission = Permission::destroy($permission);

        if($permission){
            Session::flash('success', 'Permission deleted Successfully.');
            return redirect()->back();
        }else{
            Session::flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }

    }
}