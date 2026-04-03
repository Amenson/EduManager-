<?php

namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Models\Classe;

class ClasseController extends Controller
{
    public function index()
    {
        $classes = Classe::withCount('eleves')
            ->where('titulaire_id', auth()->id())
            ->orWhereHas('emploisDuTemps', function ($query) {
                $query->where('enseignant_id', auth()->id());
            })
            ->orderBy('nom')
            ->get();

        return view('enseignant.classes.index', compact('classes'));
    }
}
