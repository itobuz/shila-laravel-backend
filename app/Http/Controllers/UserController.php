<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Role;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::all()->load('roles');
        return view('backend.admin.users.list')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = new User();
        $roles = $user->roleList();
        if (count($roles) <= 0) {
            flash('Please create a role first');
            return redirect('dashboard/admin/role/create');
        }
        $attached = array();
        return view('backend.admin.users.create')->with('roles', $roles)->with('attached', $attached);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request) {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->attachUser($input, $user);
        flash('User created succesfully!');
        return redirect('dashboard/admin/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::find($id);
        $roles = $user->roleList();
        $attached = array();
        foreach ($user->roles as $attachedrole) {
            $attached = $attachedrole->id;
        }
        return view('backend.admin.users.edit')->with('user', $user)->with('roles', $roles)->with('attached', $attached);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id) {
        $input = $request->all();
        $user = User::find($id);
        $user->updateUser($input, $user);
        $user->attachUser($input, $user);
        $roles =  $user->roleList();
        if (count($roles) <= 0) {
            flash('Please create a role first');
            return redirect('dashboard/admin/role/create');
        }
        flash('User updated succesfully!');
        return redirect('dashboard/admin/user')->with('user', $user);
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id) {
        User::destroy($id);
        flash('User deleted succesfully!');
        return redirect('dashboard/admin/user');
    }

    /*
     * Edit Profile 
     * Method get
     */

    public function getProfile() {
        $user = Auth::user();
        return view('backend.admin.users.profile')->with('user', $user);
    }

    /*
     *  Update profile
     *  Method Post
     */

    public function postProfile(UpdateUserRequest $request) {
        $input = $request->all();
        $user = Auth::user();
        $user->updateUser($input, $user);
        flash('User updated succesfully!');
        return redirect('dashboard/profile');
    }

    public function getLogout() {
        Auth::logout();
        flash('User logged out sucessfully!');
        return redirect('/login');
    }

}
