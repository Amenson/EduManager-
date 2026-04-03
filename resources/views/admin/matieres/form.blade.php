@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <h1 class="h4 mb-4">{{ $title }}</h1>
    <form method="POST" action="{{ $action }}">
        @csrf
        @if ($method !== 'POST') @method($method) @endif
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Nom</label><input class="form-control" name="nom" value="{{ old('nom', $matiere->nom) }}" required></div>
            <div class="col-md-6"><label class="form-label">Code</label><input class="form-control" name="code" value="{{ old('code', $matiere->code) }}" required></div>
            <div class="col-md-6"><label class="form-label">Coefficient</label><input type="number" step="0.5" class="form-control" name="coefficient" value="{{ old('coefficient', $matiere->coefficient) }}" required></div>
            <div class="col-md-6"><label class="form-label">Volume horaire</label><input type="number" class="form-control" name="volume_horaire" value="{{ old('volume_horaire', $matiere->volume_horaire) }}" required></div>
        </div>
        <div class="mt-4"><button class="btn btn-primary">Enregistrer</button></div>
    </form>
</div></div>
@endsection
