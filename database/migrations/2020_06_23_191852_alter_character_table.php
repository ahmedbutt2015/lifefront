<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCharacterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characters',function(Blueprint $table) {
            $table->dropColumn('notification_on');
            $table->boolean('notify_updates')->default(false);
            $table->boolean('notify_new_letter')->default(false);
            $table->boolean('notify_opportunity')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
