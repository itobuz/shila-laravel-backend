<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pcategory;
use App\Http\Requests\CreatePcategoryRequest;

class PcategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $pcategories = Pcategory::all();
        return view('backend.admin.pcategories.list')->with('pcategories', $pcategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.admin.pcategories.create')->with('image', '');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePcategoryRequest $request) {
        $input = $request->all();
        $pcategory = new Pcategory();
        $input['image'] = $pcategory->handleFile($request);
        $addCategory = $pcategory->addPcategory($input, $pcategory);
        flash('Product Category created sucessfully!');
        return redirect('dashboard/admin/product-categories');
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
        $pcategory = Pcategory::find($id);
        return view('backend.admin.pcategories.edit')->with('pcategory', $pcategory)->with('image', $pcategory->image);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePcategoryRequest $request, $id) {
        $input = $request->all();
        $pcategory = Pcategory::find($id);
        $input['image'] = $pcategory->updateHandleFile($request, $pcategory);
        $pcategory->update($input);
        flash('Product Category updated sucessfully!');
        return redirect('dashboard/admin/product-categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Pcategory::destroy($id);
        flash('Product Category deleted succesfully!');
        return redirect('dashboard/admin/product-categories');
    }

}
