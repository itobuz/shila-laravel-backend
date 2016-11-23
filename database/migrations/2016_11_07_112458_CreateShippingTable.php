<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('shippings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->text('first_name');
            $table->text('last_name');
            $table->text('customer_email');
            $table->text('customer_phone');
            $table->text('country');
            $table->text('customer_address');
            $table->text('town');
            $table->text('state');
            $table->text('zip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('shippings');
    }

}
