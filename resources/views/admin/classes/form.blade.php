@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <h1 class="h4 mb-4">{{ $title }}</h1>
    <form method="POST" action="{{ $action }}">
        @csrf
        @if ($method !== 'POST') @method($method) @endif
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Nom</label><input class="form-control" name="nom" value="{{ old('nom', $classe->nom) }}" required></div>
            <div class="col-md-6"><label class="form-label">Niveau</label><input class="form-control" name="niveau" value="{{ old('niveau', $classe->niveau) }}" required></div>
            <div class="col-md-4"><label class="form-label">Serie</label><input class="form-control" name="serie" value="{{ old('serie', $classe->serie) }}"></div>
            <div class="col-md-4"><label class="form-label">Capacite</label><input type="number" class="form-control" name="capacite" value="{{ old('capacite', $classe->capacite ?: 40) }}" required></div>
            <div class="col-md-4"><label class="form-label">Annee scolaire</label><input type="number" class="form-control" name="annee_scolaire" value="{{ old('annee_scolaire', $classe->annee_scolaire ?: date('Y')) }}" required></div>
            <div class="col-md-6"><label class="form-label">Titulaire</label><select class="form-select" name="titulaire_id"><option value="">Aucun</option>@foreach ($enseignants as $enseignant)<option value="{{ $enseignant->id }}" @selected((int) old('titulaire_id', $classe->titulaire_id) === $enseignant->id)>{{ $enseignant->prenom }} {{ $enseignant->nom }}</option>@endforeach</select></div>
        </div>
        <div class="mt-4"><button class="btn btn-primary">Enregistrer</button></div>
    </form>
</div></div>
@endsection
