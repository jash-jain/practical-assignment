<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountyServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('county_service', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('county_id');
            $table->unsignedBigInteger('service_id');

            $table->timestamps();

            $table->foreign('county_id')->references('id')->on('counties');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('county_service');
    }
}
