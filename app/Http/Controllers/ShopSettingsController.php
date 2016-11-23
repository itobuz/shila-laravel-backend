<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShopSetting;

class ShopSettingsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $settings = ShopSetting::all()->first();
        return view('backend.admin.shop.view')->with('settings', $settings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.admin.shop.settings');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'stripe_secret_key' => 'required',
            'stripe_public_key' => 'required',
        ]);
        ShopSetting::create($request->all());
        flash('Shop settinhgs save succesfully!');
        return redirect('dashboard/admin/eshop');
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
        $setting = ShopSetting::find($id);
        return view('backend.admin.shop.edit')->with('setting', $setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'stripe_secret_key' => 'required',
            'stripe_public_key' => 'required',
        ]);
        $input = $request->all();
        $settings = ShopSetting::find($id);
        $settings->update($input);
        flash('Settings updated sucessfully!');
        return redirect('dashboard/admin/eshop');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
