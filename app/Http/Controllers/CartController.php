<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller {
    
    
    /*
     * cart list page
     */
    
    public function getCartList(){
        return view('backend.admin.cart.index');
    }


    /*
     * Add to cart page
     */

    public function postAddToCart(Request $request) {
        $product = Product::findOrFail($request->input('id'));
        Cart::add(['id' => $product->id, 'name' => $product->product_title, 'qty' => $request->input('qty'), 'price' => $product->price, 'options' => ['image' => $product->product_featuredimage]]);
        return redirect('dashboard/admin/cart');
    }

    /*
     * update cart
     */

    public function postUpdateCart(Request $request) {
        Cart::update($request->id, $request->qty);
         return redirect('dashboard/admin/cart');
    }

    /*
     * Remove cart 
     */

    public function getRemoveCartItem($id) {
        Cart::remove($id);
         return redirect('dashboard/admin/cart');
    }

}
