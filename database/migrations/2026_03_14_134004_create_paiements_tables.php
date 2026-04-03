<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('paiements', function (Blueprint $table) {
    $table->id();
    $table->foreignId('eleve_id')->constrained();
    $table->decimal('montant', 10, 2);
    $table->enum('type', ['inscription', 'scolarite', 'cantine', 'autre']);
    $table->enum('statut', ['en_attente', 'paye', 'partiel', 'annule']);
    $table->date('date_paiement')->nullable();
    $table->string('mode_paiement')->nullable();
    $table->string('reference')->unique();
    $table->foreignId('recu_par')->nullable()->constrained('users');
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
        Schema::dropIfExists('paiements');
    }
}
