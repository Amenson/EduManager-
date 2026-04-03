<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('notes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('eleve_id')->constrained();
    $table->foreignId('matiere_id')->constrained();
    $table->foreignId('enseignant_id')->constrained('users');
    $table->decimal('valeur', 5, 2);
    $table->enum('trimestre', ['T1', 'T2', 'T3']);
    $table->enum('type_evaluation', ['devoir', 'composition', 'interrogation']);
    $table->year('annee_scolaire');
    $table->text('commentaire')->nullable();
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
        Schema::dropIfExists('notes');
    }
}