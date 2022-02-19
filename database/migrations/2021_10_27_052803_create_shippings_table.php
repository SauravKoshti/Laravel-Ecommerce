<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->increments('shipping_id');
            $table->string('shipping_name',20);
            $table->integer('shipping_price');
            $table->string('shipping_weight',8);
            $table->string('shipping_city',15);
            $table->string('shipping_state',15);
            $table->integer('shipping_pin');
            $table->string('shipping_phone',11);
            $table->string('shipping_restriction',25);
            $table->string('shipping_description',50);
            $table->boolean('shipping_signature_required');
            $table->string('shipping_size',15);
            $table->string('shipping_packaging_type',25);
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
        Schema::dropIfExists('shippings');
    }
}
