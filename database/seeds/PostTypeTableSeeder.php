<?php

use Illuminate\Database\Seeder;

class PostTypeTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \App\Posttype::create([
            'name' => 'Post',
        ]);
    }

}
