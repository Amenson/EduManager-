<?php

namespace App\Http\Controllers\Comptable;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comptable\PaiementRequest;
use App\Models\Eleve;
use App\Models\Paiement;
use App\Notifications\PaiementConfirme;
use Illuminate\Support\Str;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with('eleve.user')->latest('date_paiement')->paginate(20);

        return view('comptable.paiements.index', compact('paiements'));
    }

    public function create()
    {
        $eleves = Eleve::with('user')->orderBy('matricule')->get();

        return view('comptable.paiements.form', compact('eleves'));
    }

    public function store(PaiementRequest $request)
    {
        $data = $request->validated();

        $paiement = Paiement::create([
            'eleve_id' => $data['eleve_id'],
            'montant' => $data['montant'],
            'type' => $data['type'],
            'statut' => 'paye',
            'date_paiement' => now(),
            'mode_paiement' => $data['mode_paiement'],
            'reference' => $this->generateReference(),
            'recu_par' => auth()->id(),
        ]);

        $paiement->load('eleve.user');

        if ($paiement->eleve?->user) {
            $paiement->eleve->user->notify(new PaiementConfirme($paiement));
        }

        return redirect()->route('comptable.paiements.show', $paiement)
            ->with('success', "Paiement enregistre. Reference: {$paiement->reference}");
    }

    public function show(Paiement $paiement)
    {
        $paiement->load(['eleve.user', 'comptable']);

        return view('comptable.paiements.show', compact('paiement'));
    }

    public function genererRecu(Paiement $paiement)
    {
        $paiement->load(['eleve.user', 'comptable']);

        return view('paiements.recu', compact('paiement'));
    }

    private function generateReference(): string
    {
        do {
            $reference = 'PAY-' . strtoupper(Str::random(8));
        } while (Paiement::where('reference', $reference)->exists());

        return $reference;
    }
}
