<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->unsignedBigInteger('corporation_id');
            $table->foreign('corporation_id')->references('id')->on('corporations')->onDelete('cascade');
            $table->string('recheck')->nullable();
            $table->string('driver');
            $table->string('id_type');
            $table->string('id_number');
            $table->string('driver_phone');
            $table->string('interior_cabin');
            $table->string('exterior_cabin');
            $table->string('road_equipment');
            $table->string('fluids_filters');
            $table->string('direction');
            $table->string('suspension');
            $table->string('transmision');
            $table->string('brakes');
            $table->string('tires');
            $table->json('check_summary',100000);
            $table->json('porcentual_summary',1000);
            $table->string('general_observations');
            $table->integer('general_state');
            $table->date('expiration');
            $table->string('photo1');
            $table->string('photo2');
            $table->string('technician_name');
            $table->string('admin_name');
            $table->string('pdf')->nullable();
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
        Schema::dropIfExists('checks');
    }
}
