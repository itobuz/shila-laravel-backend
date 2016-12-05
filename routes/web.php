<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Auth::routes();

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    Route::group(['middleware' => ['activeUser']], function() {
        Route::get('/profile', 'UserController@getProfile');
        Route::post('/profile', 'UserController@postProfile');
        Route::get('/logout', 'UserController@getLogout');
        Route::group(array('prefix' => 'admin', 'middleware' => ['role:admin']), function() {
            Route::get('post/data', 'PostController@getData');
            Route::get('post/trash', 'PostController@getTrashed');
            Route::get('post/restore/{id}', 'PostController@getRestore');
            Route::get('post/permanent-delete/{id}', 'PostController@getPermanentDelete');
            Route::get('post/trash-data', 'PostController@getTrashData');


            Route::get('product/data', 'ProductController@getData');
            Route::get('product/trash', 'ProductController@getTrashed');
            Route::get('product/restore/{id}', 'ProductController@getRestore');
            Route::get('product/add-to-cart/{id}', 'ProductController@getAddToCart');
            Route::get('product/permanent-delete/{id}', 'ProductController@getPermanentDelete');
            Route::get('product/trash-data', 'ProductController@getTrashData');

            Route::get('page/data', 'PageController@getData');
            Route::get('page/trash', 'PageController@getTrashed');
            Route::get('page/restore/{id}', 'PageController@getRestore');
            Route::get('page/permanent-delete/{id}', 'PageController@getPermanentDelete');
            Route::get('page/trash-data', 'PageController@getTrashData');

            Route::get('order/trash', 'OrderController@getTrashed');
            Route::get('order/restore/{id}', 'OrderController@getRestore');
            Route::get('order/permanent-delete/{id}', 'OrderController@getPermanentDelete');
            Route::post('order/status', 'OrderController@postChangeStatus');
            Route::get('order/refund', 'OrderController@getRefunds');

            Route::resource('role', 'RoleController');
            Route::post('permission/attachment', 'PermissionController@postRoleAttachment');
            Route::resource('permission', 'PermissionController');
            Route::resource('user', 'UserController');
            Route::resource('posttype', 'PosttypeController');
            Route::resource('post', 'PostController');
            Route::resource('page', 'PageController');
            Route::resource('categories', 'CategoryController');
            Route::resource('product-categories', 'PcategoryController');
            Route::resource('product', 'ProductController');
            Route::resource('order', 'OrderController');
            Route::resource('eshop', 'ShopSettingsController');
        });
    });
});

/*
 * Front end route
 */
@include('frontend.php');

