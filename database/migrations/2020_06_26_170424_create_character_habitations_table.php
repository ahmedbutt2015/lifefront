<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterHabitationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::create('character_habitations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('character_id');
            $table->unsignedBigInteger('neighbourhood_id');
            $table->timestamps();
        });
        Schema::create('habitation_indications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habitation_id');
            $table->unsignedBigInteger('indication_id');
            $table->float('points');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::dropIfExists('character_habitations');
        Schema::dropIfExists('habitation_indications');
    }


}
