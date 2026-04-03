@extends('layouts.app')

@section('title', 'Fiche eleve')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0">{{ $eleve->nom_complet }}</h1>
    <a class="btn btn-warning" href="{{ route('admin.eleves.edit', $eleve) }}">Modifier</a>
</div>
<div class="row g-4">
    <div class="col-lg-6">
        <div class="card shadow-sm"><div class="card-header">Informations generales</div><div class="card-body">
            <p><strong>Matricule:</strong> {{ $eleve->matricule }}</p>
            <p><strong>Classe:</strong> {{ $eleve->classe->nom ?? '-' }}</p>
            <p><strong>Email:</strong> {{ $eleve->user->email ?? '-' }}</p>
            <p><strong>Sexe:</strong> {{ $eleve->sexe }}</p>
            <p><strong>Nationalite:</strong> {{ $eleve->nationalite }}</p>
            <p class="mb-0"><strong>Adresse:</strong> {{ $eleve->adresse ?: '-' }}</p>
        </div></div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow-sm"><div class="card-header">Synthese</div><div class="card-body">
            <p><strong>Nombre de notes:</strong> {{ $eleve->notes->count() }}</p>
            <p><strong>Nombre d absences:</strong> {{ $eleve->absences->count() }}</p>
            <p><strong>Nombre de paiements:</strong> {{ $eleve->paiements->count() }}</p>
            <p class="mb-0"><strong>Parent:</strong> {{ $eleve->parent?->prenom }} {{ $eleve->parent?->nom }}</p>
        </div></div>
    </div>
</div>
@endsection
