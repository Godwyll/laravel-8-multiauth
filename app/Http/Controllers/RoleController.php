<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('view-permissions')) {
            session()->flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();
        }

        $roles = Role::all();
        return view('roles.index', ['roles' => $roles]);
    }

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

        $role =  new Role;

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $role->name = $request->input('name');
        $role->description = $request->input('description');

        try {
            $role->save();
            session()->flash('success', 'Role created Successfully.');
        } catch (\Throwable $th) {
            session()->flash('error', 'Sorry, something went wrong.');
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('administer-permissions')) {
            session()->flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();
        }

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
        if (!auth()->user()->can('administer-permissions')) {
            session()->flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();
        }

        $role = Role::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $role->name = $request->input('name');
        $role->staff_id = $request->input('staff_id');

        try {
            $role->save();
            session()->flash('success', 'Role updated Successfully.');
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
            Role::destroy($id);
            session()->flash('success', 'Role deleted Successfully.');
        } catch (\Throwable $th) {
            session()->flash('error', 'Sorry, something went wrong.');
        }
        return redirect()->back();
    }
}
