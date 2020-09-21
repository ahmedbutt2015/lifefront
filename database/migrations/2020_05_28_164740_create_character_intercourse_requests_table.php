<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterIntercourseRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_intercourse_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requested_to');
            $table->unsignedBigInteger('requested_by');
            $table->boolean('use_protection');
            $table->integer('quantity');
            $table->enum('status',['pending','accepted','rejected'])->default('pending');
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
        Schema::dropIfExists('character_intercourse_requests');
    }
}
