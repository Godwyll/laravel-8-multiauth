<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Permission, Role};
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
        if (!Auth::user()->can('view-permissions')) {
            Session::flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();          
        }   

        $permissions = Permission::all();
        $roles = Role::with('permissions')->get();
        return view('permissions.index', ['permissions' => $permissions, 'roles' => $roles]);
        
        Session::flash('error', 'Sorry, you are not authorized to access this resource.');
        return redirect()->back();        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->can('administer-permissions')) {
            Session::flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();          
        }    

        $permission =  new Permission;

        $this->validate($request, [
            'name' => 'required',
        ]);

        $permission->name = $request->input('name');
        $permission->slug = Str::slug($request->input('name'));

        try {
            $permission->save();
            Session::flash('success', 'Permission created Successfully.');
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
        if (!Auth::user()->can('administer-permissions')) {
            Session::flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();          
        }

        $permission = Permission::findOrFail($id);
        return view('permissions.edit', ['permission' => $permission]);
        
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
        if (!Auth::user()->can('administer-permissions')) {
            Session::flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();
        }

        $permission = Permission::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
        ]);

        $permission->name = $request->input('name');
        $permission->slug = Str::slug($request->input('name'));

        try {
            $permission->save();
            Session::flash('success', 'Permission updated Successfully.');
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
        if (!Auth::user()->can('administer-permissions')) {
            Session::flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();  
        }
        
        try {
            Permission::destroy($id);
            Session::flash('success', 'Permission deleted Successfully.');
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }
    }
}