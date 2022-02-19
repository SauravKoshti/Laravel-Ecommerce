<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('suppliers_id', 3);
            $table->string('company_name', 30);
            $table->string('company_suppliers_name', 25);
            $table->string('suppliers_address', 50);
            $table->string('suppliers_city', 20);
            $table->string('suppliers_state', 15);
            $table->integer('suppliers_pin_code');
            $table->string('suppliers_country', 15);
            $table->integer('suppliers_phone');
            $table->string('suppliers_email', 25);
            $table->string('suppliers_payment_method', 15);
            $table->integer('discount_amount');
            $table->string('suppliers_final_rate');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
