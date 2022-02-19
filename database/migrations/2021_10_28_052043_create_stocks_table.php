<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('stock_id', 3);
            $table->integer('stock_brand_id')->nullable()->unsigned();
            $table->foreign('stock_brand_id')->references('brand_id')->on('brands');
            $table->integer('stock_product_id')->nullable()->unsigned();
            $table->foreign('stock_product_id')->references('product_id')->on('products');
            $table->integer('total_stock');
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
        Schema::dropIfExists('stocks');
    }
}
