<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantPlatesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::create('restaurant_plates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('keeper_id');
            $table->unsignedBigInteger('product_id');
            $table->float('quantity');
            $table->float('price')->default(0);
            $table->enum('status', ['in_process', 'back', 'front', 'sold','consumed'])->default('in_process');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::dropIfExists('restaurant_plates');
    }


}
