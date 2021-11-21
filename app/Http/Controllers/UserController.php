<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
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

        if($user->save()){
            Session::flash('success', 'User created Successfully.');
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
        $user = User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
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

        if($user->save()){
            Session::flash('success', 'User updated Successfully.');
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
        $user = User::destroy($id);

        if($user){
            Session::flash('success', 'User deleted Successfully.');
            return redirect()->back();            
        }else{
            Session::flash('error', 'Sorry, something went wrong.');
            return redirect()->back();
        }
    }
}
