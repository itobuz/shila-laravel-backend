<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Page;
use Yajra\Datatables\Facades\Datatables;
use Form;
use App\Http\Requests\CreatePageRequest;

class PageController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('backend.admin.page.list');
    }

    /*
     * Get data grid data
     */

    public function getData() {
        $pages = Page::select('*');
        return Datatables::eloquent($pages)
                        ->addColumn('action', function ($pages) {
                            $result = '';
                            $result.='<a href="page/' . $pages->id . '/edit" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                            $result.= Form::open(['route' => ['page.destroy', $pages->id], 'method' => 'DELETE', 'class' => 'inline']) . '
                            <button class="btn btn-primary btn-circle delete-button"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                            ' . Form::close();
                            return $result;
                        })
                        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.admin.page.create')->with('page_featuredimage', '');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePageRequest $request) {
        $input = $request->all();
        $page = new Page();
        $input['page_featuredimage'] = $page->handleFile($request);
        $addedPage = $page->addPage($input, $page);
        flash('Page created sucessfully!');
        return redirect('dashboard/admin/page');
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
        $page = Page::find($id);
        return view('backend.admin.page.edit')->with('page', $page)->with('page_featuredimage', $page->page_featuredimage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePageRequest $request, $id) {
        $input = $request->all();
        $page = Page::find($id);
        $input['page_featuredimage'] = $page->updateHandleFile($request, $page);
        $page->update($input);
        flash('Page updated sucessfully!');
        return redirect('dashboard/admin/page');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Page::destroy($id);
        flash('Page deleted succesfully!');
        return redirect('dashboard/admin/page');
    }

    /*
     * Disaply Trash posts
     * method get
     */

    public function getTrashed() {
        return view('backend.admin.page.trash');
    }

    /*
     * Get data grid  trashed data
     */

    public function getTrashData() {
        $allpages = Page::select('*');
        $pages = $allpages->withTrashed();
        return Datatables::eloquent($pages)
                        ->addColumn('action', function ($pages) {
                            $result = '';
                            $result.='<a href="restore/' . $pages->id . '" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-edit"></i> Restore</a>';
                            $result.= '<a href="permanent-delete/' . $pages->id . '" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                            return $result;
                        })
                        ->make(true);
    }

    /*
     * Restore trash posts
     */

    public function getRestore($id) {
        $page = Page::onlyTrashed()->where('id', $id);
        $page->restore();
        flash('Page restore sucessfully!');
        return redirect('dashboard/admin/page');
    }

    /*
     * Force delete posts
     */

    public function getPermanentDelete($id) {
        $page = Page::onlyTrashed()->where('id', $id);
        $page->forceDelete();
        flash('Page deleted sucessfully!');
        return redirect('dashboard/admin/page');
    }

}
