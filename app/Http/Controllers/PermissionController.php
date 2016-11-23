<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Permission;
use App\Role;
use Laracasts\Flash\Flash;

class PermissionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $permisions = Permission::all();
        $roles = Role::all();
        return view('backend.admin.permission.list')->with('permissions', $permisions)->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionCreateRequest $request) {
        Permission::create($request->all());
        flash('Permission created sucessfully');
        return redirect('dashboard/admin/permission');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $permission = Permission::find($id);
        return view('backend.admin.permission.edit')->with('permission', $permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionUpdateRequest $request, $id) {
        $input = $request->all();
        $permissison = Permission::find($id);
        $inputs = $permissison->arrangeInputs($input, $permissison);
        $permissison->update($inputs);
        flash('Permission updated succesfully!');
        return redirect('dashboard/admin/permission')->with('permission', $permissison);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    /*
     * Attached specfic role to permisson
     * Ajax function
     */

    public function postRoleAttachment(Request $request) {

        if ($request->ajax()) {
            $role = Role::findOrFail($request->roleId);
            $permissions = Permission::findOrFail($request->permissionId);

            if ($request->status == 'true') {
                $role->attachPermission($permissions);
                return response()->json(['msg' => 'Permission attached succcesfullly']);
            } else {
                $role->detachPermission($permissions);
                return response()->json(['msg' => 'Permission detached succcesfullly']);
            }
        }
    }

}
