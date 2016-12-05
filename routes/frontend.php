<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Route::get('products/list', 'ProductController@frontendList');
Route::get('products/view/{id}', 'ProductController@frontendSingleView');

Route::get('cart', 'CartController@getCartList');
Route::post('cart/add-to-cart/', 'CartController@postAddToCart');
Route::post('cart/update-cart/', 'CartController@postUpdateCart');
Route::get('cart/remove-cart-item/{id}', 'CartController@getRemoveCartItem');

Route::get('checkout/payment', 'CheckoutController@getShowCheckoutForm');
Route::post('checkout/payment', 'CheckoutController@postCheckoutForm');
