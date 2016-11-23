<?php

namespace App;

use Laratrust\LaratrustRole;

class Role extends LaratrustRole {

    protected $fillable = ['name', 'display_name', 'description'];

    /*
     * Many to many relation with users
     */

    public function users() {
        return $this->belongsToMany('App\User');
    }

    /*
     * Arrange inputs for update
     * return array
     */

    public function arrangeInputs($input, $role) {
        if ($role->name == $input['name']) {
            unset($input['name']);
        }
        return $input;
    }

}
