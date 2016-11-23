<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stripe\Refund;

class Order extends Model {

    use SoftDeletes;

    public $fillable = ['payment_type', 'price', 'chargeid', 'refund', 'status'];
    protected $dates = ['deleted_at'];

    public function shippings() {
        return $this->hasMany('App\Shipping');
    }

    public function orderitems() {
        return $this->hasMany('App\OrderItem');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    /*
     * Refund order in stripe
     */

    public function createRefund($input) {
        $refund = Refund::create(['charge' => $input['charge_id']]);
        if ($refund->status == 'succeeded') {
            return $refund->id;
        } else {
            return '';
        }
    }

}
