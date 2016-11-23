<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopSetting extends Model {

    public $fillable = ['stripe_secret_key', 'stripe_public_key'];
    protected $table = 'eshopsettings';

}
