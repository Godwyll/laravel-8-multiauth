<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPermission;
use Session;
use Auth;

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_permission = UserPermission::findOrFail($id);
        return view('user-permissions.show', ['user_permission' => $user_permission]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_permission = UserPermission::destroy($id);

        if($user_permission){
            Session::flash('success', 'User Permission deleted Successfully.');
            return redirect()->back();
        }else{
            Session::flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }

    }
}
