<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class Posttype extends Model {

    protected $fillable = ['name'];

    /*
     * Create controller file using artisan command
     */

    public static function createController($name) {
        Artisan::call('make:controller', ['name' => $name . 'Controller', '--resource' => true]);
        return true;
    }

    /*
     * post Relation one to many
     */

    public function posts() {
        return $this->hasMany('App\Post');
    }

}
