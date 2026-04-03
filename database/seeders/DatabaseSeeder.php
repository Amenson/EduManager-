<?php

namespace Database\Seeders;

use App\Models\Classe;
use App\Models\Matiere;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@scolarite.test'],
            [
                'nom' => 'Admin',
                'prenom' => 'Super',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'actif' => true,
            ]
        );

        Classe::factory()->count(3)->create();

        Matiere::firstOrCreate(['code' => 'MAT'], ['nom' => 'Mathematiques', 'coefficient' => 4, 'volume_horaire' => 5]);
        Matiere::firstOrCreate(['code' => 'FRA'], ['nom' => 'Francais', 'coefficient' => 3, 'volume_horaire' => 4]);
    }
}
