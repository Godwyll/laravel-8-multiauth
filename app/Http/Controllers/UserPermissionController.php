<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPermission;

class UserPermissionController extends Controller
{
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

        $user_permission =  new UserPermission;

        $this->validate($request, [
            'permission_id' => 'required',
            'user_id' => 'required',
        ]);

        $user_permission->user_id = $request->input('user_id');
        $user_permission->permission_id = $request->input('permission_id');
        $user_permission->created_by = auth()->user()->id;

        try {
            $user_permission->save();
            session()->flash('success', 'User Permission created Successfully.');
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
            UserPermission::destroy($id);
            session()->flash('success', 'User Permission deleted Successfully.');
        } catch (\Throwable $th) {
            session()->flash('error', 'Sorry, something went wrong.');
        }
        return redirect()->back();
    }
}
