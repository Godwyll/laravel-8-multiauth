<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Auth;
use Hash;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('view-users')) {
            $users = User::all();
            return view('users.index', ['users'=>$users]);
        }
        // abort(403);
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
        if (Auth::user()->can('add-users')) {
            return view('users.create');
        }
        
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
        if (Auth::user()->can('add-users')) {
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
                Session::flash('success', 'User created Successfully.');
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->can('view-users')) {
            $user = User::findOrFail($id);
            return view('users.show', ['user' => $user]);
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
        if (Auth::user()->can('edit-users')) {
            $user = User::findOrFail($id);
            return view('users.edit', ['user' => $user]);
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
        if (Auth::user()->can('edit-users')) {
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
                Session::flash('success', 'User updated Successfully.');
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
        if (Auth::user()->can('delete-users')) {
            try {
                User::destroy($id);
                Session::flash('success', 'User deleted Successfully.');
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
