<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmploiDuTempsRequest;
use App\Models\Classe;
use App\Models\EmploiDuTemps;
use App\Models\Matiere;
use App\Models\User;

class EmploiController extends Controller
{
    public function index()
    {
        $emplois = EmploiDuTemps::with(['classe', 'matiere', 'enseignant'])
            ->orderBy('jour')
            ->orderBy('heure_debut')
            ->get();

        return view('admin.emplois.index', [
            'emplois' => $emplois,
            'classes' => Classe::orderBy('nom')->get(),
            'matieres' => Matiere::orderBy('nom')->get(),
            'enseignants' => User::where('role', 'enseignant')->orderBy('nom')->get(),
        ]);
    }

    public function store(EmploiDuTempsRequest $request)
    {
        EmploiDuTemps::create($request->validated());

        return redirect()->route('admin.edt')->with('success', 'Cours planifie avec succes.');
    }
}
