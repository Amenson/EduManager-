@extends('layouts.app')

@section('title', 'Paiement')

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Paiement {{ $paiement->reference }}</h1>
        <a class="btn btn-outline-primary" href="{{ route('comptable.paiements.recu', $paiement) }}">Afficher le recu</a>
    </div>
    <p><strong>Eleve:</strong> {{ $paiement->eleve->nom_complet }}</p>
    <p><strong>Montant:</strong> {{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</p>
    <p><strong>Type:</strong> {{ $paiement->type }}</p>
    <p><strong>Mode:</strong> {{ $paiement->mode_paiement }}</p>
    <p class="mb-0"><strong>Comptable:</strong> {{ $paiement->comptable?->prenom }} {{ $paiement->comptable?->nom }}</p>
</div></div>
@endsection
