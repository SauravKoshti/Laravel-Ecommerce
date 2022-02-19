<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id', 3);
            $table->string('product_name', 20);
            $table->string('product_images', 200);
            $table->string('product_description');
            $table->integer('product_quantity');
            $table->string('product_restricrated_state', 150)->nullable();
            $table->string('product_restricrated_city', 150)->nullable();

            $table->integer('product_brand_id')->nullable()->unsigned();
            $table->foreign('product_brand_id')->references('brand_id')->on('brands');

            $table->float('product_sale_price', 8, 2);

            $table->integer('product_tax_percentage')->nullable()->unsigned();
            $table->foreign('product_tax_percentage')->references('gst_id')->on('gsts');
            
            $table->integer('offer_id')->nullable()->unsigned();
            $table->foreign('offer_id')->references('offer_id')->on('offers');

            $table->string('product_variants', 300);

            $table->integer('product_suppliers_id')->nullable()->unsigned();
            $table->foreign('product_suppliers_id')->references('suppliers_id')->on('suppliers');

            $table->integer('product_status');
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
        Schema::dropIfExists('products');
    }
}
