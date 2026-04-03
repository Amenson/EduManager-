@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="card shadow-sm">
    <div class="card-body p-5 text-center">
        <h1 class="display-6 mb-3">Application de gestion scolaire</h1>
        <p class="lead text-muted mb-4">Gestion des eleves, classes, notes, absences et paiements dans une seule interface Laravel.</p>
        <a class="btn btn-primary btn-lg" href="{{ route('login') }}">Se connecter</a>
    </div>
</div>
@endsection
