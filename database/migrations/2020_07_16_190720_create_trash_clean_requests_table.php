<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrashCleanRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trash_clean_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('dust_man');
            $table->unsignedBigInteger('requested_by');
            $table->unsignedBigInteger('habitation_id');
            $table->unsignedSmallInteger('indication_id');
            $table->float('trash_points');
            $table->float('total');
            $table->enum('status',['pending','close']);
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
        Schema::dropIfExists('trash_clean_requests');
    }
}
