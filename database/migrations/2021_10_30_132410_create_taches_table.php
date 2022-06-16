<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taches', function (Blueprint $table) {
            $table->id();
            $table->string('designation');
            $table->string('title', 200); // nomEnt/prestation
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('allDay');
            $table->string('color');
            $table->string('textColor');
            $table->integer('status');
            $table->unsignedBigInteger('mission_id');
            $table->foreign('mission_id')->references('id')->on('missions');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('taches');
    }
}