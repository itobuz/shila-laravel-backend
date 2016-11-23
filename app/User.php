<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use App\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable {

    use LaratrustUserTrait,
        Notifiable,
        Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
     * Update user 
     * method post
     */

    public function updateUser($input, $user) {
        if ($user->email == $input['email']) {
            unset($input['email']);
        }
        if ($input['password'] != '') {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }
        $user->update($input);
        return true;
    }

    /*
     * Attach user to a specfic role
     * method post
     */

    public function attachUser($input, $user) {
        if ($user->roles->count() > 0) {
            if ($user->hasRole(Role::find($input['roles'])->name) == false) {
                $user->detachRoles($user->roles);
                $user->roles()->attach($input['roles']);
            }
        } else {
            $user->roles()->attach($input['roles']);
        }
        return true;
    }

    /*
     * show list of availble roles
     */

    public function roleList() {
        $roles = array();
        foreach ((Role::all()) as $role) {
            $roles[$role->id] = $role->name;
        }
        return $roles;
    }

    /*
     * Many to many relation with roles
     */

    public function roles() {
        return $this->belongsToMany('App\Role');
    }
    
    public function orders() {
        return $this->hasMany('App\Order');
    }

}
