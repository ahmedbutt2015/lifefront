<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactoryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factory_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('factory_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('product_id');
            $table->float('price');
            $table->float('quantity');
            $table->enum('status',['pending','inprocess','accepted','closed','rejected','robbed']);
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
        Schema::dropIfExists('factory_orders');
    }
}