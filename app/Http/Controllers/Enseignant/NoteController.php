<?php

namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Enseignant\StoreNotesRequest;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Matiere;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $classes = Classe::orderBy('nom')->get();
        $matieres = Matiere::orderBy('nom')->get();
        $eleves = collect();
        $notes = collect();

        if ($request->filled('classe_id')) {
            $eleves = Eleve::with('user')
                ->where('classe_id', $request->integer('classe_id'))
                ->orderBy('matricule')
                ->get();

            $notes = Note::with(['eleve.user', 'matiere'])
                ->whereHas('eleve', fn ($query) => $query->where('classe_id', $request->integer('classe_id')))
                ->latest()
                ->get();
        }

        return view('enseignant.notes.index', compact('classes', 'matieres', 'eleves', 'notes'));
    }

    public function saisirNotes(StoreNotesRequest $request)
    {
        $validated = $request->validated();

        foreach ($validated['notes'] as $eleveId => $data) {
            Note::updateOrCreate(
                [
                    'eleve_id' => $eleveId,
                    'matiere_id' => $validated['matiere_id'],
                    'trimestre' => $validated['trimestre'],
                    'annee_scolaire' => now()->year,
                ],
                [
                    'valeur' => $data['valeur'],
                    'type_evaluation' => $data['type'],
                    'enseignant_id' => auth()->id(),
                    'commentaire' => $data['commentaire'] ?? null,
                ]
            );
        }

        return back()->with('success', 'Notes enregistrees avec succes.');
    }
}
