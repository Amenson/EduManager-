@extends('layouts.app')

@section('title', 'Absences')

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card shadow-sm"><div class="card-body">
            <h1 class="h4 mb-4">Nouvelle absence</h1>
            <form method="POST" action="{{ route('enseignant.absences.store') }}">
                @csrf
                <div class="mb-3"><label class="form-label">Eleve ID</label><input type="number" class="form-control" name="eleve_id" required></div>
                <div class="mb-3"><label class="form-label">Matiere</label><select class="form-select" name="matiere_id"><option value="">Aucune</option>@foreach ($matieres as $matiere)<option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>@endforeach</select></div>
                <div class="mb-3"><label class="form-label">Date</label><input type="date" class="form-control" name="date" required></div>
                <div class="mb-3"><label class="form-label">Heure debut</label><input type="time" class="form-control" name="heure_debut"></div>
                <div class="mb-3"><label class="form-label">Heure fin</label><input type="time" class="form-control" name="heure_fin"></div>
                <div class="mb-3"><label class="form-label">Motif</label><textarea class="form-control" name="motif"></textarea></div>
                <button class="btn btn-primary">Enregistrer</button>
            </form>
        </div></div>
    </div>
    <div class="col-lg-8">
        <div class="card shadow-sm"><div class="card-body">
            <h2 class="h5 mb-3">Historique des absences</h2>
            <div class="table-responsive"><table class="table">
                <thead><tr><th>Eleve</th><th>Date</th><th>Matiere</th><th>Motif</th></tr></thead>
                <tbody>
                @forelse ($absences as $absence)
                    <tr>
                        <td>{{ $absence->eleve->nom_complet }}</td>
                        <td>{{ optional($absence->date)->format('d/m/Y') }}</td>
                        <td>{{ $absence->matiere->nom ?? '-' }}</td>
                        <td>{{ $absence->motif ?: '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">Aucune absence.</td></tr>
                @endforelse
                </tbody>
            </table></div>
            <div>{{ $absences->links() }}</div>
        </div></div>
    </div>
</div>
@endsection
