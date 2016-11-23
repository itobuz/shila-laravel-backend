<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\Http\Requests\CreateCategoryRequest;

class CategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categories = Category::all();
        return view('backend.admin.categories.list')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.admin.categories.create')->with('featuredimage', '');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request) {
        $input = $request->all();
        $category = new Category();
        $input['featuredimage'] = $category->handleFile($request);
        $addedCategory = $category->addCategory($input, $category);
        flash('Category created sucessfully!');
        return redirect('dashboard/admin/categories');
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
        $category = Category::find($id);
        return view('backend.admin.categories.edit')->with('category', $category)->with('featuredimage', $category->featuredimage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCategoryRequest $request, $id) {
        $input = $request->all();
        $category = Category::find($id);
        $input['featuredimage'] = $category->updateHandleFile($request, $category);
        $category->update($input);
        flash('Category updated sucessfully!');
        return redirect('dashboard/admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Category::destroy($id);
        flash('Category deleted succesfully!');
        return redirect('dashboard/admin/categories');
    }

}
