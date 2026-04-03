<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absence;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Paiement;

class RapportController extends Controller
{
    public function index()
    {
        $stats = [
            'eleves' => Eleve::count(),
            'classes' => Classe::count(),
            'absences' => Absence::count(),
            'paiements' => Paiement::where('statut', 'paye')->sum('montant'),
        ];

        return view('admin.rapports.index', compact('stats'));
    }
}
