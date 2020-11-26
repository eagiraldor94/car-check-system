<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('corporation_id');
            $table->foreign('corporation_id')->references('id')->on('corporations')->onDelete('cascade');
            $table->string('propietary');
            $table->string('id_type');
            $table->string('id_number');
            $table->string('plate');
            $table->string('brand');
            $table->string('type');
            $table->string('model');
            $table->string('inscription');
            $table->date('SOAT_expiration');
            $table->integer('SOAT_notification')->default(0);
            $table->date('technician_check_expiration');
            $table->integer('technician_notification')->default(0);
            $table->integer('check_notification')->default(0);
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
        Schema::dropIfExists('vehicles');
    }
}
