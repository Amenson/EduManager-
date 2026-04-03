@extends('layouts.app')

@section('title', 'Recu')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm"><div class="card-body">
            <h1 class="h4 mb-4">Recu de paiement</h1>
            <p><strong>Reference:</strong> {{ $paiement->reference }}</p>
            <p><strong>Eleve:</strong> {{ $paiement->eleve->nom_complet }}</p>
            <p><strong>Montant:</strong> {{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</p>
            <p><strong>Date:</strong> {{ optional($paiement->date_paiement)->format('d/m/Y H:i') }}</p>
            <p><strong>Mode:</strong> {{ $paiement->mode_paiement }}</p>
            <p class="mb-0"><strong>Encaisse par:</strong> {{ $paiement->comptable?->prenom }} {{ $paiement->comptable?->nom }}</p>
        </div></div>
    </div>
</div>
@endsection
