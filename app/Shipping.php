<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model {

    public $fillable = ['first_name', 'last_name', 'customer_email', 'customer_phone', 'country', 'customer_address', 'town', 'state', 'zip'];

    public function order() {
        return $this->belongsTo('App\Order');
    }

}
