<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offer_id');
            $table->unsignedBigInteger('applied_by');
            $table->unsignedBigInteger('job_id');
            $table->enum('status', ['applied', 'accepted', 'rejected']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::dropIfExists('job_applications');
    }


}
