@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h1 class="h4 mb-4">{{ $title }}</h1>
        <form method="POST" action="{{ $action }}">
            @csrf
            @if ($method !== 'POST')
                @method($method)
            @endif
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Nom</label><input class="form-control" name="nom" value="{{ old('nom', $eleve->user->nom ?? '') }}" required></div>
                <div class="col-md-6"><label class="form-label">Prenom</label><input class="form-control" name="prenom" value="{{ old('prenom', $eleve->user->prenom ?? '') }}" required></div>
                <div class="col-md-6"><label class="form-label">Email</label><input type="email" class="form-control" name="email" value="{{ old('email', $eleve->user->email ?? '') }}" required></div>
                <div class="col-md-6"><label class="form-label">Date de naissance</label><input type="date" class="form-control" name="date_naissance" value="{{ old('date_naissance', $eleve->date_naissance ?? '') }}" required></div>
                <div class="col-md-6"><label class="form-label">Lieu de naissance</label><input class="form-control" name="lieu_naissance" value="{{ old('lieu_naissance', $eleve->lieu_naissance ?? '') }}" required></div>
                <div class="col-md-3"><label class="form-label">Sexe</label><select class="form-select" name="sexe"><option value="M" @selected(old('sexe', $eleve->sexe ?? '') === 'M')>Masculin</option><option value="F" @selected(old('sexe', $eleve->sexe ?? '') === 'F')>Feminin</option></select></div>
                <div class="col-md-3"><label class="form-label">Nationalite</label><input class="form-control" name="nationalite" value="{{ old('nationalite', $eleve->nationalite ?? 'Togolaise') }}"></div>
                <div class="col-md-6">
                    <label class="form-label">Classe</label>
                    <select class="form-select" name="classe_id">
                        @foreach ($classes as $classe)
                            <option value="{{ $classe->id }}" @selected((int) old('classe_id', $eleve->classe_id ?? 0) === $classe->id)>{{ $classe->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Parent</label>
                    <select class="form-select" name="parent_id">
                        <option value="">Aucun</option>
                        @foreach ($parents as $parent)
                            <option value="{{ $parent->id }}" @selected((int) old('parent_id', $eleve->parent_id ?? 0) === $parent->id)>{{ $parent->prenom }} {{ $parent->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12"><label class="form-label">Adresse</label><textarea class="form-control" name="adresse" rows="3">{{ old('adresse', $eleve->adresse ?? '') }}</textarea></div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-primary">Enregistrer</button>
                <a class="btn btn-outline-secondary" href="{{ route('admin.eleves.index') }}">Retour</a>
            </div>
        </form>
    </div>
</div>
@endsection
