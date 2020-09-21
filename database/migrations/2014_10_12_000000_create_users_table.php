<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::table('users', function (Blueprint $table) {
//            $table->id();
            $table->string('username')->unique();
//            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
//            $table->string('password')->nullable();
            $table->timestamp('rules_accepted_at')->nullable();
//            $table->string('image')->nullable();
//            $table->string('provider')->nullable();
//            $table->rememberToken();
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::table('users',function (Blueprint  $blueprint) {
            $blueprint->dropColumn(['username','email_verified_at','rules_accepted_at']);
        });
    }


}
