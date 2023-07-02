<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('view-users')) {
            session()->flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();
        }

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('add-users')) {
            session()->flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();
        }

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('add-users')) {
            session()->flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();
        }

        $user = new User;

        $this->validate($request, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        try {
            $user->save();
            session()->flash('success', 'User created Successfully.');
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('error', 'Sorry, something went wrong.');
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
        if (!auth()->user()->can('view-users')) {
            session()->flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();
        }

        $user = User::findOrFail($id);
        return view('admin.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('edit-users')) {
            session()->flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();
        }

        $user = User::findOrFail($id);
        return view('admin.users.edit', ['user' => $user]);
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
        if (!auth()->user()->can('edit-users')) {
            session()->flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();
        }

        $user = User::findOrFail($id);

        $this->validate($request, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->username = $request->input('username');
        $user->email = $request->input('email');

        if($request->input('password')){
            $this->validate($request, [
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);

            $user->password = Hash::make($request->input('password'));
        }

        try {
            $user->save();
            session()->flash('success', 'User updated Successfully.');
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('error', 'Sorry, something went wrong.');
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
        if (!auth()->user()->can('delete-users')) {
            session()->flash('error', 'Sorry, you are not authorized to access this resource.');
            return redirect()->back();
        }

        try {
            User::destroy($id);
            session()->flash('success', 'User deleted Successfully.');
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }
    }
}
