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
        if (Auth::user()->can('view-permissions')) {
            $roles = Role::all();
            return view('roles.index', ['roles' => $roles]);
        }
        
        Session::flash('error', 'Sorry, you are not authorized to access this resource.');
        return redirect()->back();        
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
        if (Auth::user()->can('administer-permissions')) {
            $role =  new Role;
    
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
            ]);
    
            $role->name = $request->input('name');
            $role->description = $request->input('description');
    
            try {
                $role->save();
                Session::flash('success', 'Role created Successfully.');
                return redirect()->back();
            } catch (\Throwable $th) {
                Session::flash('error', 'Sorry, something went wrong.');
                return redirect()->back();
            }
        }
        
        Session::flash('error', 'Sorry, you are not authorized to access this resource.');
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
        if (Auth::user()->can('administer-permissions')) {
            $role = Role::findOrFail($id);
            return view('roles.edit')->with('role', $role);
        }
        
        Session::flash('error', 'Sorry, you are not authorized to access this resource.');
        return redirect()->back();
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
        if (Auth::user()->can('administer-permissions')) {
            $role = Role::findOrFail($id);

            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
            ]);

            $role->name = $request->input('name');
            $role->staff_id = $request->input('staff_id');

            try {
                $role->save();
                Session::flash('success', 'Role updated Successfully.');
                return redirect()->back();
            } catch (\Throwable $th) {
                Session::flash('error', 'Sorry, something went wrong.');
                return redirect()->back();
            }
        }
        
        Session::flash('error', 'Sorry, you are not authorized to access this resource.');
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
        if (Auth::user()->can('administer-permissions')) {
            try {
                Role::destroy($id);
                Session::flash('success', 'Role deleted Successfully.');
                return redirect()->back();
            } catch (\Throwable $th) {
                Session::flash('error', 'Sorry, something went wrong.');
                return redirect()->back();
            }
        }
        
        Session::flash('error', 'Sorry, you are not authorized to access this resource.');
        return redirect()->back();
    }
}
