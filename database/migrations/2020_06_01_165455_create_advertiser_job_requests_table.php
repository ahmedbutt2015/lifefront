<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertiserJobRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertiser_job_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doer_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('age');
            $table->string('kind');
            $table->string('job');
            $table->string('neighborhoods');
            $table->string('price');
            $table->string('status');
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
        Schema::dropIfExists('advertiser_job_requests');
    }
}
