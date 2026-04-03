<?php

namespace App\Http\Controllers\Eleve;

use App\Http\Controllers\Controller;
use App\Models\EmploiDuTemps;

class EmploiController extends Controller
{
    public function index()
    {
        $eleve = auth()->user()->eleve;
        abort_unless($eleve, 404);

        $emplois = EmploiDuTemps::with(['matiere', 'enseignant'])
            ->where('classe_id', $eleve->classe_id)
            ->orderBy('jour')
            ->orderBy('heure_debut')
            ->get();

        return view('eleve.emploi.index', compact('eleve', 'emplois'));
    }
}
