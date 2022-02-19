<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
                     
 $table->increments('order_id');

 $table->integer('order_user_id')->nullable()->unsigned();
 $table->foreign('order_user_id')->references('suppliers_id')->on('suppliers');
 $table->integer('order_product_id')->nullable()->unsigned();
 $table->foreign('order_product_id')->references('product_id')->on('products');
 $table->decimal('order_amount',8);
 $table->string('order_city',50);
 $table->string('order_state',10);
 $table->integer('order_pin');
 $table->string('order_country',15);
 $table->date('order_date');
 $table->integer('order_code_number');
 $table->integer('order_status');
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
        Schema::dropIfExists('orders');
    }
}
