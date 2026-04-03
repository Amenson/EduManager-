<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsencesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
    $table->id();
    $table->foreignId('eleve_id')->constrained();
    $table->foreignId('matiere_id')->nullable()->constrained();
    $table->date('date');
    $table->time('heure_debut')->nullable();
    $table->time('heure_fin')->nullable();
    $table->boolean('justifiee')->default(false);
    $table->text('motif')->nullable();
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
        Schema::dropIfExists('absences');
    }
}
