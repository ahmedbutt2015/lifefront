<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFarmerOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('farmer_orders',function (Blueprint $table){
            $table->unsignedBigInteger('delivery_id');
            $table->float('charges');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('farmer_orders',function (Blueprint $table){
            $table->dropColumn(['delivery_id','charges']);
        });
    }
}
