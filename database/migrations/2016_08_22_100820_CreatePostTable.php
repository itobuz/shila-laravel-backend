<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('posts', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('posttype_id')->unsigned();
            $table->foreign('posttype_id')
                    ->references('id')->on('posttypes')->onDelete('cascade');
            $table->text('post_title');
            $table->text('post_content');
            $table->text('post_excerpt');
            $table->text('post_featuredimage');
            $table->dateTime('post_date');
            $table->text('post_status');
            $table->integer('menu_order');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('posts');
    }

}
