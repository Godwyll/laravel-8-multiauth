<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRole;

class UserRoleController extends Controller
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

        $user_role =  new UserRole;

        $this->validate($request, [
            'role_id' => 'required',
            'user_id' => 'required',
        ]);

        $user_role->user_id = $request->input('user_id');
        $user_role->role_id = $request->input('role_id');
        $user_role->created_by = auth()->user()->id;

        try {
            $user_role->save();
            session()->flash('success', 'User Role created Successfully.');
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
            UserRole::destroy($id);
            session()->flash('success', 'User Role deleted Successfully.');
        } catch (\Throwable $th) {
            session()->flash('error', 'Sorry, something went wrong.');
        }
        return redirect()->back();
    }
}
