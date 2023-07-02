<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Permission, Role};
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
        if (!auth()->user()->can('view-permissions')) {
            session()->flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();
        }

        $permissions = Permission::all();
        $roles = Role::with('permissions')->get();
        return view('permissions.index', ['permissions' => $permissions, 'roles' => $roles]);

        session()->flash('error', 'Sorry, you are not authorized to access this resource.');
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
        if (!auth()->user()->can('administer-permissions')) {
            session()->flash('error', 'Sorry, you are not authorized to access this resource.');
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
            session()->flash('success', 'Permission created Successfully.');
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
        if (!auth()->user()->can('administer-permissions')) {
            session()->flash('error', 'Sorry, you are not authorized to access this resource.');
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
            session()->flash('success', 'Permission updated Successfully.');
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
            Permission::destroy($id);
            session()->flash('success', 'Permission deleted Successfully.');
        } catch (\Throwable $th) {
            session()->flash('error', 'Sorry, something went wrong.');
        }
        return redirect()->back();
    }
}
