<?php

namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Enseignant\AbsenceRequest;
use App\Models\Absence;
use App\Models\Classe;
use App\Models\Matiere;

class AbsenceController extends Controller
{
    public function index()
    {
        $absences = Absence::with(['eleve.user', 'matiere'])->latest('date')->paginate(20);

        return view('enseignant.absences.index', [
            'absences' => $absences,
            'classes' => Classe::orderBy('nom')->get(),
            'matieres' => Matiere::orderBy('nom')->get(),
        ]);
    }

    public function store(AbsenceRequest $request)
    {
        Absence::create($request->validated());

        return redirect()->route('enseignant.absences')->with('success', 'Absence enregistree avec succes.');
    }
}
