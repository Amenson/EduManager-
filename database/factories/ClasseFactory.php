<?php

namespace Database\Factories;

use App\Models\Classe;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClasseFactory extends Factory
{
    protected $model = Classe::class;

    public function definition()
    {
        return [
            'nom' => '6e ' . $this->faker->randomLetter(),
            'niveau' => '6e',
            'serie' => null,
            'capacite' => 40,
            'titulaire_id' => null,
            'annee_scolaire' => (int) date('Y'),
        ];
    }
}
