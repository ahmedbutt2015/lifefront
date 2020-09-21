<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantIngredientsStocksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::create('restaurant_ingredients_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('keeper_id');
            $table->unsignedBigInteger('product_id');
            $table->float('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::dropIfExists('restaurant_ingredients_stocks');
    }


}
