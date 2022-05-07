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
        $user_roles = UserRole::all();
        return view('user-roles.index', ['user_roles' => $user_roles]);
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
        $user_role =  new UserRole;

        $this->validate($request, [
            'role_id' => 'required',
            'user_id' => 'required',
        ]);

        $user_role->created_by = $request->input('created_by');
        $user_role->role_id = $request->input('role_id');
        $user_role->user_id = Auth::user()->id;

        if($user_role->save()){
            Session::flash('success', 'User Role created Successfully.');
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
        $user_role = UserRole::findOrFail($id);
        return view('user-roles.show', ['user_role' => $user_role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_role = UserRole::findOrFail($id);

        return view('user-roles.edit', ['user_role' => $user_role]);
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
        $user_role = UserRole::findOrFail($id);

        $this->validate($request, [
            'role_id' => 'required',
            'user_id' => 'required',
        ]);

        $user_role->created_by = $request->input('created_by');
        $user_role->role_id = $request->input('role_id');

        if($user_role->save()){
            Session::flash('success', 'User Role updated Successfully.');
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
        $user_role = UserRole::destroy($id);

        if($user_role){
            Session::flash('success', 'User Role deleted Successfully.');
            return redirect()->back();
        }else{
            Session::flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }

    }
}
