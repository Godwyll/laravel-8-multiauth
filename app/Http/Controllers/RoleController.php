<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Session;
use Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', ['roles' => $roles]);
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
        $role =  new Role;

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $role->name = $request->input('name');
        $role->description = $request->input('description');

        if($role->save()){
            return redirect()->back()->with('success', 'Role created Successfully.');
        }else{
            return redirect()->back()->with('error', 'Sorry, something went wrong.');
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
        $role = Role::findOrFail($id);
        return view('roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.edit')->with('role', $role);
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
        $role = Role::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $role->name = $request->input('name');
        $role->staff_id = $request->input('staff_id');

        if($role->save()){
            return redirect()->back()->with('success', 'Role updated Successfully.');
        }else{
            return redirect()->back()->with('error', 'Sorry, something went wrong.');
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
        $role = Role::destroy($id);

        if($role){
            return redirect()->back()->with('success', 'Role deleted Successfully.');
        }else{
            return redirect()->back()->with('error', 'Sorry, something went wrong.');
        }

    }
}
