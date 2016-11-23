<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Stripe\Charge;

class Checkout extends Model {

    public function createCharge($amount, $stoken) {
        $charges = Charge::create([
                    "amount" => $amount * 100,
                    "currency" => "usd",
                    "source" => $stoken,
                    "description" => "Product purchase",
        ]);
        return $charges;
    }

}
