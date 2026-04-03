@extends('layouts.app')

@section('title', 'Emploi du temps')

@section('content')
<div class="row g-4">
    <div class="col-lg-5">
        <div class="card shadow-sm"><div class="card-body">
            <h1 class="h4 mb-4">Planifier un cours</h1>
            <form method="POST" action="{{ route('admin.edt.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-12"><label class="form-label">Classe</label><select class="form-select" name="classe_id">@foreach ($classes as $classe)<option value="{{ $classe->id }}">{{ $classe->nom }}</option>@endforeach</select></div>
                    <div class="col-12"><label class="form-label">Matiere</label><select class="form-select" name="matiere_id">@foreach ($matieres as $matiere)<option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>@endforeach</select></div>
                    <div class="col-12"><label class="form-label">Enseignant</label><select class="form-select" name="enseignant_id">@foreach ($enseignants as $enseignant)<option value="{{ $enseignant->id }}">{{ $enseignant->prenom }} {{ $enseignant->nom }}</option>@endforeach</select></div>
                    <div class="col-md-4"><label class="form-label">Jour</label><select class="form-select" name="jour">@foreach (['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'] as $jour)<option value="{{ $jour }}">{{ $jour }}</option>@endforeach</select></div>
                    <div class="col-md-4"><label class="form-label">Debut</label><input type="time" class="form-control" name="heure_debut"></div>
                    <div class="col-md-4"><label class="form-label">Fin</label><input type="time" class="form-control" name="heure_fin"></div>
                    <div class="col-12"><label class="form-label">Salle</label><input class="form-control" name="salle"></div>
                </div>
                <div class="mt-4"><button class="btn btn-primary">Enregistrer</button></div>
            </form>
        </div></div>
    </div>
    <div class="col-lg-7">
        <div class="card shadow-sm"><div class="card-body">
            <h2 class="h5 mb-3">Cours planifies</h2>
            <div class="table-responsive"><table class="table">
                <thead><tr><th>Jour</th><th>Heure</th><th>Classe</th><th>Matiere</th><th>Enseignant</th></tr></thead>
                <tbody>
                @forelse ($emplois as $emploi)
                    <tr>
                        <td>{{ $emploi->jour }}</td>
                        <td>{{ $emploi->heure_debut }} - {{ $emploi->heure_fin }}</td>
                        <td>{{ $emploi->classe->nom }}</td>
                        <td>{{ $emploi->matiere->nom }}</td>
                        <td>{{ $emploi->enseignant->prenom }} {{ $emploi->enseignant->nom }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">Aucun cours planifie.</td></tr>
                @endforelse
                </tbody>
            </table></div>
        </div></div>
    </div>
</div>
@endsection
