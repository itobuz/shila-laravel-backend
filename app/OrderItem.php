<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {

    protected $table = 'orderitems';
    public $fillable = ['product_id','qty'];

    public function order() {
        return $this->belongsTo('App\Order');
    }

}
