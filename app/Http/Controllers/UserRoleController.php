<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRole;
use Session;
use Auth;

class UserRoleController extends Controller
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

        $user_permission->user_id = $request->input('user_id');
        $user_permission->permission_id = $request->input('permission_id');
        $user_permission->created_by = Auth::user()->id;

        try {
            $user_permission->save();
            Session::flash('success', 'User Permission created Successfully.');
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_permission = UserPermission::findOrFail($id);
        return view('user-permissions.edit', ['user_permission' => $user_permission]);
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
        $user_permission = UserPermission::findOrFail($id);

        $this->validate($request, [
            'permission_id' => 'required',
            'user_id' => 'required',
        ]);

        $user_permission->user_id = $request->input('user_id');
        $user_permission->permission_id = $request->input('permission_id');

        try {
            $user_permission->save();
            Session::flash('success', 'User Permission updated Successfully.');
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
            UserPermission::destroy($id);
            Session::flash('success', 'User Permission deleted Successfully.');
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }
    }
}
