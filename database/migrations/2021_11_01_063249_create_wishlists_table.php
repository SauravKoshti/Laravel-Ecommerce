<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->increments('wishlist_id', 3);
            $table->bigInteger('wishlist_user_id')->nullable()->unsigned();
            $table->foreign('wishlist_user_id')->references('id')->on('users');
            $table->integer('wishlist_product_id')->nullable()->unsigned();
            $table->foreign('wishlist_product_id')->references('product_id')->on('products');
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
        Schema::dropIfExists('wishlists');
    }
}
