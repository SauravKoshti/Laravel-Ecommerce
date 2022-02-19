<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('cart_id', 3);
            $table->bigInteger('cart_user_id')->nullable()->unsigned();
            $table->foreign('cart_user_id')->references('id')->on('users');
            $table->integer('cart_product_id')->nullable()->unsigned();
            $table->foreign('cart_product_id')->references('product_id')->on('products');
            $table->string('variant',100);
            $table->integer('cart_product_qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
