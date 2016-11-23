<?php

namespace App;

use Laratrust\LaratrustPermission;

class Permission extends LaratrustPermission {

    protected $fillable = ['name', 'display_name', 'description'];

    /*
     * Arrange inputs for update
     * return array
     */

    public function arrangeInputs($input, $permissison) {
        if ($permissison->name == $input['name']) {
            unset($input['name']);
        }
        return $input;
    }

}
