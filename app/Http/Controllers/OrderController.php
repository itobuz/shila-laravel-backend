<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Stripe\Stripe;
use App\ShopSetting;

class OrderController extends Controller {

    public function __construct() {
        if (count(\App\ShopSetting::all()) > 0) {
            Stripe::setApiKey(ShopSetting::all()->first()->stripe_public_key);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $orders = Order::all()->load('orderitems', 'shippings');
        return view('backend.admin.order.list')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $order = Order::find($id)->load('orderitems', 'shippings');
        return view('backend.admin.order.view')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Order::destroy($id);
        flash('Order deleted succesfully!');
        return redirect('dashboard/admin/order');
    }

    /*
     * Disaply Trash orders
     * method get
     */

    public function getTrashed() {
        $orders = Order::onlyTrashed()->with('orderitems', 'shippings')->get();
        return view('backend.admin.order.trash')->with('orders', $orders);
    }

    /*
     * Restore trash orders
     */

    public function getRestore($id) {
        $order = Order::onlyTrashed()->where('id', $id);
        $order->restore();
        flash('Order restore sucessfully!');
        return redirect('dashboard/admin/order');
    }

    /*
     * Force delete orders
     */

    public function getPermanentDelete($id) {
        $order = Order::onlyTrashed()->where('id', $id);
        $order->forceDelete();
        flash('Order permanently deleted');
        return redirect('dashboard/admin/order');
    }

    /*
     * Change order status 
     * method post
     */

    public function postChangeStatus(Request $request) {
        $input = $request->all();
        $order = new Order();
        if ($input['order-status'] == 'refund') {
            if ($input['charge_id'] != '') {
                $refund = $order->createRefund($input);
            } else {
                $refund = 'cashondelivary_' . $input['order_id'];
            }
        }
        if ($refund != '') {
            Order::where('id', $input['order_id'])->update(['refund' => $refund]);
            $this->readdItems($input);
        } else {
            flash('There is somthing wrong in refund process');
            return redirect('dashboard/admin/order/' . $input['order_id'] . '');
        }

        Order::where('id', $input['order_id'])->update(['status' => $input['order-status']]);
        if ($input['order-status'] == 'cancel') {
            $this->readdItems($input);
        }
        flash('Status update sucessfully');
        return redirect('dashboard/admin/order/' . $input['order_id'] . '');
    }

    /*
     * Show refund orders 
     */

    public function getRefunds() {
        $orders = Order::where('status', 'refund')->with('orderitems', 'shippings')->get();
        return view('backend.admin.order.refund')->with('orders', $orders);
    }

    /*
     * Increse products after refund or canceling the order
     */

    public function readdItems($input) {
        $orderItems = \App\OrderItem::where('order_id', $input['order_id'])->get();
        foreach ($orderItems as $orderItem) {
            \App\Product::where('id', $orderItem->product_id)->increment('qty', $orderItem->qty);
        }
    }

}
