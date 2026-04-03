@extends('layouts.app')

@section('title', 'Mon emploi du temps')

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <h1 class="h4 mb-3">Emploi du temps de {{ $eleve->classe->nom ?? '-' }}</h1>
    <div class="table-responsive"><table class="table">
        <thead><tr><th>Jour</th><th>Horaire</th><th>Matiere</th><th>Enseignant</th><th>Salle</th></tr></thead>
        <tbody>
        @forelse ($emplois as $emploi)
            <tr>
                <td>{{ $emploi->jour }}</td>
                <td>{{ $emploi->heure_debut }} - {{ $emploi->heure_fin }}</td>
                <td>{{ $emploi->matiere->nom }}</td>
                <td>{{ $emploi->enseignant->prenom }} {{ $emploi->enseignant->nom }}</td>
                <td>{{ $emploi->salle }}</td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center">Aucun cours planifie.</td></tr>
        @endforelse
        </tbody>
    </table></div>
</div></div>
@endsection
