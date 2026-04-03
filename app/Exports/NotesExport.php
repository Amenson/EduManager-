<?php
// app/Exports/NotesExport.php
namespace App\Exports;

use App\Models\Note;
use Maatwebsite\Excel\Concerns\{FromQuery, WithHeadings, WithMapping, ShouldAutoSize};

class NotesExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize {

    public function __construct(
        private int $classe_id,
        private string $trimestre,
        private int $annee
    ) {}

    public function query() {
        return Note::with(['eleve.user', 'matiere'])
            ->whereHas('eleve', fn($q) => $q->where('classe_id', $this->classe_id))
            ->where('trimestre', $this->trimestre)
            ->where('annee_scolaire', $this->annee);
    }

    public function headings(): array {
        return ['Matricule', 'Nom', 'Prénom', 'Matière', 'Note', 'Trimestre'];
    }

    public function map($note): array {
        return [
            $note->eleve->matricule,
            $note->eleve->user->nom,
            $note->eleve->user->prenom,
            $note->matiere->nom,
            $note->valeur,
            $note->trimestre,
        ];
    }
}

