<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Posttype;
use App\Http\Requests\CreatePosttypeRequest;
use App\Http\Requests\UpdatePosttypeRequest;

class PosttypeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posttypes = Posttype::all();

        return view('backend.admin.posttype.list')->with('posttypes', $posttypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.admin.posttype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePosttypeRequest $request) {
        Posttype::create($request->all());
        Posttype::createController($request->input('name'));
        flash('Post type created successfully! ');
        return redirect('dashboard/admin/posttype');
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
        $posttype = Posttype::find($id);
        return view('backend.admin.posttype.edit')->with('posttype', $posttype);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePosttypeRequest $request, $id) {
        $posttype = Posttype::find($id);
        $posttype->update($request->all());
        flash('Post type updated sucessfully!');
        return redirect('dashboard/admin/posttype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Posttype::destroy($id);
        flash('Post type deleted succesfully!');
        return redirect('dashboard/admin/posttype');
    }

}
