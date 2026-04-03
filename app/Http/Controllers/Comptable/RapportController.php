<?php

namespace App\Http\Controllers\Comptable;

use App\Http\Controllers\Controller;
use App\Models\Paiement;

class RapportController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with('eleve.user')->latest('date_paiement')->paginate(20);
        $total = Paiement::where('statut', 'paye')->sum('montant');

        return view('comptable.rapport.index', compact('paiements', 'total'));
    }
}
