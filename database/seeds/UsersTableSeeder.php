<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $admin = User::create([
                    'name' => 'Admin',
                    'email' => 'admin@admin.com',
                    'password' => Hash::make('admin123'),
                    'status' => 1,
        ]);
        $admin->roles()->attach(1);

        $author = User::create([
                    'name' => 'Author',
                    'email' => 'author@author.com',
                    'password' => Hash::make('author123'),
                    'status' => 1,
        ]);
        $author->roles()->attach(2);
    }

}
