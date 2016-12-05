<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use App\Checkout;
use App\Http\Requests\ShippingRequest;
use App\Product;
use App\ShopSetting;

class CheckoutController extends Controller {

    public function __construct() {
        if (count(\App\ShopSetting::all()) > 0) {
            Stripe::setApiKey(ShopSetting::all()->first()->stripe_secret_key);
        }
    }

    /*
     * Show chcekout form
     * @param void
     * return checkout form
     */

    public function getShowCheckoutForm() {
        if (Auth::check()) {
            return view('frontend.checkout.checkout');
        }
        flash('You must login first to checkout');
        return redirect('login');
    }

    /*
     * Submit checkout form
     */

    public function postCheckoutForm(ShippingRequest $request) {

        $amount = str_replace(',', '', Cart::total());
        $stripe_token = $request->get('stripeToken');
        $checkout = new Checkout();
        if ($request->get('payment_type') == 'Credit card') {
            $charges = $checkout->createCharge($amount, $stripe_token);
            if ($charges->failure_code == '') {
                $this->creditCardPayment($request, $charges);
                flash('Order created sucessfully');
                return redirect('products/list');
            }
        } elseif ($request->get('payment_type') == 'Cash on dailivary') {
            $this->cashOnDelivary($request);
            flash('Order created sucessfully');
            return redirect('products/list');
        } else {
            flash('Something went wrong. Please try again sometime');
            return redirect('cart');
        }
    }

    public function creditCardPayment($request, $charges) {
        $orderInput = ['payment_type' => $request->get('payment_type'), 'price' => Cart::total(), 'chargeid' => $charges->id, 'refund' => '', 'status' => 'processing'];
        $order = Auth::user()->orders()->create($orderInput);
        foreach (Cart::content() as $row) {
            $order->orderitems()->create(['product_id' => $row->id, 'qty' => $row->qty]);
            Product::where('id', $row->id)->decrement('qty', $row->qty);
        }
        $order->shippings()->create($request->all());
        Cart::destroy();
    }

    public function cashOnDelivary($request) {
        $orderInput = ['payment_type' => $request->get('payment_type'), 'price' => Cart::total(), 'chargeid' => '', 'refund' => '', 'status' => 'processing'];
        $order = Auth::user()->orders()->create($request->all());
        foreach (Cart::content() as $row) {
            $order->orderitems()->create(['product_id' => $row->id, 'qty' => $row->qty]);
            Product::where('id', $row->id)->decrement('qty', $row->qty);
        }
        $order->shippings()->create($request->all());
        Cart::destroy();
    }

}
