<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Role::create(
                [
                    'name' => 'admin',
                    'display_name' => 'Admin',
                    'Description' => 'This is admin role.'
        ]);
        Role::create(
                [
                    'name' => 'author',
                    'display_name' => 'Author',
                    'Description' => 'This is author role.'
                ]
        );
    }

}
