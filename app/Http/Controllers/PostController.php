<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Posttype;
use App\Http\Requests\CreatePostRequest;
use Yajra\Datatables\Facades\Datatables;
use Form;
use App\Category;

class PostController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('backend.admin.post.list');
    }

    /*
     * Get data grid data
     */

    public function getData() {
        $posttype_id = Posttype::whereName('post')->first()->id;
        $posts = Post::select('*')->where('posttype_id', '=', $posttype_id);
        return Datatables::eloquent($posts)
                        ->addColumn('action', function ($posts) {
                            $result = '';
                            $result.='<a href="post/' . $posts->id . '/edit" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                            $result.= Form::open(['route' => ['post.destroy', $posts->id], 'method' => 'DELETE', 'class' => 'inline']) . '
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
        $categories = Category::pluck('categories.name', 'categories.id');
        return view('backend.admin.post.create')->with('post_featuredimage', '')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request) {
        $input = $request->all();
        $input['post_featuredimage'] = Post::handleFile($request);
        $post = new Post();
        $posttype = Posttype::find($input['posttype_id']);
        $addedPost = Post::addPost($input, $post, $posttype);
        $addedPost->categories()->sync($input['category_list']);
        flash('Post created sucessfully!');
        return redirect('dashboard/admin/post');
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
        $post = Post::find($id);
        $categories = Category::pluck('categories.name', 'categories.id');
        return view('backend.admin.post.edit')->with('post', $post)->with('post_featuredimage', $post->post_featuredimage)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePostRequest $request, $id) {
        $input = $request->all();
        $post = Post::find($id);
        $input['post_featuredimage'] = Post::updateHandleFile($request, $post);
        $post->update($input);
        $post->categories()->sync($input['category_list']);
        flash('Post updated sucessfully!');
        return redirect('dashboard/admin/post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Post::destroy($id);
        flash('Post deleted succesfully!');
        return redirect('dashboard/admin/post');
    }

    /*
     * Disaply Trash posts
     * method get
     */

    public function getTrashed() {
        return view('backend.admin.post.trash');
    }

    /*
     * Get data grid  trashed data
     */

    public function getTrashData() {
        $posttype_id = Posttype::whereName('post')->first()->id;
        $posts = Post::onlyTrashed()->where('posttype_id', '=', $posttype_id);
        return Datatables::eloquent($posts)
                        ->addColumn('action', function ($posts) {
                            $result = '';
                            $result.='<a href="restore/' . $posts->id . '" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-edit"></i> Restore</a>';
                            $result.= '<a href="permanent-delete/' . $posts->id . '" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                            return $result;
                        })
                        ->make(true);
    }

    /*
     * Restore trash posts
     */

    public function getRestore($id) {
        $post = Post::onlyTrashed()->where('id', $id);
        $post->restore();
        flash('Post restore sucessfully!');
        return redirect('dashboard/admin/post');
    }

    /*
     * Force delete posts
     */

    public function getPermanentDelete($id) {
        $post = Post::onlyTrashed()->where('id', $id);
        $post->forceDelete();
        flash('Post deleted sucessfully!');
        return redirect('dashboard/admin/post');
    }

}
