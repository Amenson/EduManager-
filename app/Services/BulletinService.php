<?php

namespace App\Services;

use App\Models\Eleve;
use App\Models\Note;

class BulletinService
{
    public function buildBulletinData(Eleve $eleve, string $trimestre, int $annee): array
    {
        $eleve->loadMissing('classe');

        $notes = Note::with('matiere')
            ->where('eleve_id', $eleve->id)
            ->where('trimestre', $trimestre)
            ->where('annee_scolaire', $annee)
            ->orderBy('matiere_id')
            ->get();

        $moyenne = $eleve->moyenneGenerale($trimestre, $annee);
        $mention = $this->calculerMention($moyenne);
        $rang = $this->calculerRang($eleve, $trimestre, $annee);
        $effectif = $eleve->classe ? $eleve->classe->eleves()->count() : 0;
        $appreciation = $this->genererAppreciation($moyenne);

        return compact(
            'eleve',
            'notes',
            'moyenne',
            'mention',
            'rang',
            'effectif',
            'appreciation',
            'trimestre',
            'annee'
        );
    }

    public function genererBulletin(Eleve $eleve, string $trimestre, int $annee): array
    {
        return $this->buildBulletinData($eleve, $trimestre, $annee);
    }

    private function calculerRang(Eleve $eleve, string $trimestre, int $annee): int
    {
        $eleves = Eleve::where('classe_id', $eleve->classe_id)->get();
        $moyennes = $eleves->map(fn ($item) => [
            'id' => $item->id,
            'moy' => $item->moyenneGenerale($trimestre, $annee),
        ])->sortByDesc('moy')->values();

        $position = $moyennes->search(fn ($moyenne) => $moyenne['id'] === $eleve->id);

        return $position === false ? 0 : $position + 1;
    }

    private function calculerMention(float $moyenne): string
    {
        return match (true) {
            $moyenne >= 16 => 'Tres bien',
            $moyenne >= 14 => 'Bien',
            $moyenne >= 12 => 'Assez bien',
            $moyenne >= 10 => 'Passable',
            default => 'Insuffisant',
        };
    }

    private function genererAppreciation(float $moyenne): string
    {
        return match (true) {
            $moyenne >= 16 => 'Excellent travail.',
            $moyenne >= 14 => 'Bon trimestre.',
            $moyenne >= 12 => 'Resultats satisfaisants.',
            $moyenne >= 10 => 'Peut mieux faire.',
            default => 'Des efforts supplementaires sont attendus.',
        };
    }
}
