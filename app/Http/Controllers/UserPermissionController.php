<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_permissions = UserPermission::all();
        return view('user-permissions.index', ['user_permissions' => $user_permissions]);
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
        $user_permission =  new UserPermission;

        $this->validate($request, [
            'permission_id' => 'required',
            'user_id' => 'required',
        ]);

        $user_permission->added_by = $request->input('added_by');
        $user_permission->permission_id = $request->input('permission_id');
        $user_permission->user_id = Auth::user()->id;

        if($user_permission->save()){
            Session::flash('success', 'User Permission created Successfully.');
            return redirect()->back();
        }else{
            Session::flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPermission  $user_permission
     * @return \Illuminate\Http\Response
     */
    public function show(UserPermission $user_permission)
    {
        $user_permission = UserPermission::findOrFail($user_permission);
        return view('user-permissions.show', ['user_permission' => $user_permission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPermission  $user_permission
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPermission $user_permission)
    {
        $user_permission = UserPermission::findOrFail($user_permission);

        return view('user-permissions.edit', ['user_permission' => $user_permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserPermission  $user_permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserPermission $user_permission)
    {
        $user_permission = UserPermission::findOrFail($user_permission);

        $this->validate($request, [
            'permission_id' => 'required',
            'user_id' => 'required',
        ]);

        $user_permission->added_by = $request->input('added_by');
        $user_permission->permission_id = $request->input('permission_id');

        if($user_permission->save()){
            Session::flash('success', 'User Permission updated Successfully.');
            return redirect()->back();
        }else{
            Session::flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPermission  $user_permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPermission $user_permission)
    {
        $user_permission = UserPermission::destroy($user_permission);

        if($user_permission){
            Session::flash('success', 'User Permission deleted Successfully.');
            return redirect()->back();
        }else{
            Session::flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }

    }
}
