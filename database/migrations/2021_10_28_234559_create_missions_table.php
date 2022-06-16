<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200); // nomEnt/prestation
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('allDay');
            $table->string('color');
            $table->string('textColor');
            $table->unsignedBigInteger('devis_id')->nullable();
            $table->foreign('devis_id')->references('id')->on('devis');
            $table->unsignedBigInteger('prestation_id')->nullable();;
            $table->foreign('prestation_id')->references('id')->on('prestations');
            $table->unsignedBigInteger('entreprise_id');
            $table->foreign('entreprise_id')->references('id')->on('entreprises');
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
        Schema::dropIfExists('missions');
    }
}