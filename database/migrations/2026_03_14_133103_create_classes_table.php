<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');           // Ex: 3ème A, Terminal S
            $table->string('niveau');        // Ex: 3ème, Terminal
            $table->string('serie')->nullable(); // Ex: A, S, D
            $table->integer('capacite')->default(50);
            $table->foreignId('titulaire_id')->nullable()->constrained('users');
            $table->year('annee_scolaire');
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
        Schema::dropIfExists('classes');
    }
}
