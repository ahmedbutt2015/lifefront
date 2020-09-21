<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('language');
            $table->string('gender');
            $table->string('skin_tone');
            $table->string('hair_style');
            $table->string('body_type');
            $table->integer('age');
            $table->string('status');
            $table->string('job')->nullable();
            $table->string('marriage_status')->nullable();
            $table->string('mood')->nullable();
            $table->string('role')->nullable();
            $table->longText('profile')->nullable();
            $table->string('user_status')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('code');
            $table->string('prefix');
            $table->string('address');
            $table->unsignedBigInteger('family_id');
            $table->unsignedBigInteger('user_id');
            $table->float('item_credit_quantity')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::dropIfExists('characters');
    }


}
