@extends('layouts.app')

@section('title', 'Bulletin')

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <h1 class="h4 mb-1">Bulletin - {{ $trimestre }}</h1>
    <p class="text-muted">{{ $eleve->nom_complet }} | Classe: {{ $eleve->classe->nom ?? '-' }}</p>
    <div class="row g-3 mb-4">
        <div class="col-md-3"><div class="border rounded p-3"><div class="text-muted">Moyenne</div><div class="fs-4 fw-bold">{{ $moyenne }}</div></div></div>
        <div class="col-md-3"><div class="border rounded p-3"><div class="text-muted">Mention</div><div class="fs-4 fw-bold">{{ $mention }}</div></div></div>
        <div class="col-md-3"><div class="border rounded p-3"><div class="text-muted">Rang</div><div class="fs-4 fw-bold">{{ $rang }}/{{ $effectif }}</div></div></div>
        <div class="col-md-3"><div class="border rounded p-3"><div class="text-muted">Appreciation</div><div class="small fw-semibold">{{ $appreciation }}</div></div></div>
    </div>
    <table class="table">
        <thead><tr><th>Matiere</th><th>Note</th><th>Type</th><th>Commentaire</th></tr></thead>
        <tbody>
        @forelse ($notes as $note)
            <tr>
                <td>{{ $note->matiere->nom }}</td>
                <td>{{ $note->valeur }}</td>
                <td>{{ $note->type_evaluation }}</td>
                <td>{{ $note->commentaire ?: '-' }}</td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center">Aucune note pour ce trimestre.</td></tr>
        @endforelse
        </tbody>
    </table>
</div></div>
@endsection
