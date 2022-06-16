<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('raison_social');
            $table->string('num_registre_commerce');
            $table->string('num_art_imposition');
            $table->string('num_id_fiscale');
            $table->text('adresse');
            $table->string('num_tel');
            $table->string('email');
            $table->unsignedBigInteger('fiscal_id');
            $table->foreign('fiscal_id')->references('id')->on('regime_fiscals');
            $table->unsignedBigInteger('activite_id');
            $table->foreign('activite_id')->references('id')->on('type_activites');
            $table->unsignedBigInteger('categorie_id');
            $table->foreign('categorie_id')->references('id')->on('categories');
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
        Schema::dropIfExists('entreprises');
    }
}