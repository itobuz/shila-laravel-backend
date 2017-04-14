<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests;
use Yajra\Datatables\Facades\Datatables;
use App\Pcategory;
use Form;
use App\Http\Requests\CreateProductRequest;

class ProductController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('backend.admin.product.list');
    }

    /*
     * Get data grid data
     */

    public function getData() {
        $products = Product::select('*');
        return Datatables::eloquent($products)
                        ->addColumn('action', function ($products) {
                            $result = '';
                            $result.='<a href="product/' . $products->id . '/edit" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                            $result.='<a href="product/' . $products->id . '" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-edit"></i> View</a>';
                            $result.= Form::open(['route' => ['product.destroy', $products->id], 'method' => 'DELETE', 'class' => 'inline']) . '
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
        $pcategory = Pcategory::pluck('pcategories.name', 'pcategories.id');
        return view('backend.admin.product.create')->with('product_featuredimage', '')->with('pcategories', $pcategory);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request) {
        $input = $request->all();
        $product = new Product();
        $input['product_featuredimage'] = $product->handleFile($request);
        $addedProduct = $product->addProduct($input, $product);
        $addedProduct->pcategories()->sync($input['pcategory_list']);
        flash('Product created sucessfully!');
        return redirect('dashboard/admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $product = Product::find($id);

        return view('backend.admin.product.view')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $product = Product::find($id)->load('pcategories');
        $pcategory = Pcategory::pluck('pcategories.name', 'pcategories.id');
        return view('backend.admin.product.edit')->with('product', $product)->with('product_featuredimage', $product->product_featuredimage)->with('pcategories', $pcategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateProductRequest $request, $id) {
        $input = $request->all();
        $product = Product::find($id);
        $input['product_featuredimage'] = $product->updateHandleFile($request, $product);
        $product->update($input);
        $product->pcategories()->sync($input['pcategory_list']);
        flash('Product updated sucessfully!');
        return redirect('dashboard/admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Product::destroy($id);
        flash('Product deleted succesfully!');
        return redirect('dashboard/admin/product');
    }

    /*
     * Disaply Trash posts
     * method get
     */

    public function getTrashed() {
        return view('backend.admin.product.trash');
    }

    /*
     * Get data grid  trashed data
     */

    public function getTrashData() {

        $product = Product::onlyTrashed();
        return Datatables::eloquent($product)
                        ->addColumn('action', function ($product) {
                            $result = '';
                            $result.='<a href="restore/' . $product->id . '" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-edit"></i> Restore</a>';
                            $result.= '<a href="permanent-delete/' . $product->id . '" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                            return $result;
                        })
                        ->make(true);
    }

    /*
     * Restore trash posts
     */

    public function getRestore($id) {
        $product = Product::onlyTrashed()->where('id', $id);
        $product->restore();
        flash('Product restore sucessfully!');
        return redirect('dashboard/admin/product');
    }

    /*
     * Force delete posts
     */

    public function getPermanentDelete($id) {
        $product = Product::onlyTrashed()->where('id', $id);
        $product->forceDelete();
        flash('Product deleted sucessfully!');
        return redirect('dashboard/admin/product');
    }

    /*
     * Show product list in front end
     * return lst of data
     */

    public function frontendList() {
        $products = Product::where('product_status', 'publish')->paginate(9);
        return view('frontend.products.list')->with('products', $products);
    }

    /* show single product view in front end
     * 
     */

    public function frontendSingleView($id) {
        $product = Product::find($id);

        return view('frontend.products.view')->with('product', $product);
    }

}
