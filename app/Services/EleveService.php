<?php

namespace App\Services;

use App\Models\Eleve;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EleveService
{
    public function create(array $data): Eleve
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'email' => $data['email'],
                'password' => Hash::make($this->defaultPassword()),
                'role' => 'eleve',
            ]);

            return Eleve::create([
                'user_id' => $user->id,
                'matricule' => $this->generateMatricule(),
                'date_naissance' => $data['date_naissance'],
                'lieu_naissance' => $data['lieu_naissance'],
                'sexe' => $data['sexe'],
                'nationalite' => $data['nationalite'] ?? 'Togolaise',
                'adresse' => $data['adresse'] ?? null,
                'classe_id' => $data['classe_id'],
                'parent_id' => $data['parent_id'] ?? null,
                'annee_inscription' => now()->year,
            ]);
        });
    }

    public function update(Eleve $eleve, array $data): Eleve
    {
        return DB::transaction(function () use ($eleve, $data) {
            $eleve->load('user');

            $eleve->user->update([
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'email' => $data['email'],
            ]);

            $eleve->update([
                'date_naissance' => $data['date_naissance'],
                'lieu_naissance' => $data['lieu_naissance'],
                'sexe' => $data['sexe'],
                'nationalite' => $data['nationalite'] ?? 'Togolaise',
                'adresse' => $data['adresse'] ?? null,
                'classe_id' => $data['classe_id'],
                'parent_id' => $data['parent_id'] ?? null,
            ]);

            return $eleve->fresh(['user', 'classe', 'parent']);
        });
    }

    public function archive(Eleve $eleve): void
    {
        DB::transaction(function () use ($eleve) {
            $eleve->user()->update(['actif' => false]);
            $eleve->delete();
        });
    }

    public function defaultPassword(): string
    {
        return 'scolarite' . now()->year;
    }

    private function generateMatricule(): string
    {
        do {
            $matricule = 'ELV-' . now()->year . '-' . strtoupper(Str::random(5));
        } while (Eleve::where('matricule', $matricule)->exists());

        return $matricule;
    }
}
