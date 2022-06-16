<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('num_fact');
            $table->date('date_facturation');
            $table->decimal('montant', 16, 2);
            $table->unsignedBigInteger('mission_id')->nullable();
            $table->foreign('mission_id')->references('id')->on('missions');
            $table->unsignedBigInteger('exercice_id')->nullable();
            $table->foreign('exercice_id')->references('id')->on('exercices');
            $table->unsignedBigInteger('type_facture_id')->nullable();
            $table->foreign('type_facture_id')->references('id')->on('type_factures');
            $table->unsignedBigInteger('fact_avoir_id')->nullable();
            $table->foreign('fact_avoir_id')->references('id')->on('factures');
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
        Schema::dropIfExists('factures');
    }
}