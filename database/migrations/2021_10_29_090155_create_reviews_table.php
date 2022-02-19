<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('review_id', 3);
            $table->bigInteger('review_user_id')->nullable()->unsigned();
            $table->foreign('review_user_id')->references('id')->on('users');
            $table->integer('review_product_id')->nullable()->unsigned();
            $table->foreign('review_product_id')->references('product_id')->on('products');
            $table->string('review_comment',20);
            $table->integer('review_raiting');
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
        Schema::dropIfExists('reviews');
    }
}
