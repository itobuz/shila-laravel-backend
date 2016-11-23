<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {

    use SoftDeletes;

    public $fillable = ['product_title', 'product_content', 'product_featuredimage', 'product_date', 'product_status', 'menu_order', 'product_excerpt', 'sku', 'price','qty'];
    protected $dates = ['deleted_at'];

    /**
     * Moves uploaded file and returns the new filenam
     * @param  Symfony\Component\HttpFoundation\File\UploadedFile $file upladed file
     * @return string            new name returned
     */
    public function handleFile($request) {
        if ($request->hasFile('product_featuredimage')) {
            $fileName = time() . '_' . $request->product_featuredimage->getClientOriginalName();
            $request->product_featuredimage->storeAs('public', $fileName);
        } else {
            $fileName = '';
        }
        return $fileName;
    }

    /*
     * Update uploaded file
     */

    public function updateHandleFile($request, $product) {
        if ($request->hasFile('product_featuredimage') == FALSE) {
            $fileName = $product->product_featuredimage;
        } else {
            Storage::delete('public/' . $product->product_featuredimage);
            $fileName = time() . '_' . $request->product_featuredimage->getClientOriginalName();
            $request->product_featuredimage->storeAs('public', $fileName);
        }
        return $fileName;
    }

    /*
     * Create post function
     */

    public function addProduct($input, $product) {
        $product->product_title = $input['product_title'];
        $product->product_content = $input['product_content'];
        $product->product_featuredimage = $input['product_featuredimage'];
        $product->product_date = ($input['product_date'] == '' ? date("Y-m-d") : $input['product_date']);
        $product->product_status = $input['product_status'];
        $product->menu_order = $input['menu_order'];
        $product->product_excerpt = $input['product_excerpt'];
        $product->sku = $input['sku'];
        $product->price = $input['price'];
        $product->qty = $input['qty'];
        $product->save();
        return $product;
    }

    /**
     * The product that belong to the category.
     */
    public function pcategories() {
        return $this->belongsToMany('App\Pcategory')->withTimestamps();
    }

}
