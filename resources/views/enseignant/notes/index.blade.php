@extends('layouts.app')

@section('title', 'Notes')

@section('content')
<div class="row g-4">
    <div class="col-lg-5">
        <div class="card shadow-sm"><div class="card-body">
            <h1 class="h4 mb-4">Saisie des notes</h1>
            <form method="GET" class="mb-4">
                <label class="form-label">Classe</label>
                <select class="form-select" name="classe_id" onchange="this.form.submit()">
                    <option value="">Choisir une classe</option>
                    @foreach ($classes as $classe)
                        <option value="{{ $classe->id }}" @selected(request('classe_id') == $classe->id)>{{ $classe->nom }}</option>
                    @endforeach
                </select>
            </form>
            @if ($eleves->isNotEmpty())
                <form method="POST" action="{{ route('enseignant.notes.store') }}">
                    @csrf
                    <input type="hidden" name="classe_id" value="{{ request('classe_id') }}">
                    <div class="mb-3"><label class="form-label">Matiere</label><select class="form-select" name="matiere_id">@foreach ($matieres as $matiere)<option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>@endforeach</select></div>
                    <div class="mb-3"><label class="form-label">Trimestre</label><select class="form-select" name="trimestre"><option>T1</option><option>T2</option><option>T3</option></select></div>
                    @foreach ($eleves as $eleve)
                        <div class="border rounded p-3 mb-3">
                            <div class="fw-semibold mb-2">{{ $eleve->nom_complet }}</div>
                            <div class="row g-2">
                                <div class="col-md-4"><input type="number" step="0.01" max="20" min="0" class="form-control" name="notes[{{ $eleve->id }}][valeur]" placeholder="Note"></div>
                                <div class="col-md-4"><select class="form-select" name="notes[{{ $eleve->id }}][type]"><option value="devoir">Devoir</option><option value="composition">Composition</option><option value="interrogation">Interrogation</option></select></div>
                                <div class="col-md-4"><input class="form-control" name="notes[{{ $eleve->id }}][commentaire]" placeholder="Commentaire"></div>
                            </div>
                        </div>
                    @endforeach
                    <button class="btn btn-primary">Enregistrer</button>
                </form>
            @endif
        </div></div>
    </div>
    <div class="col-lg-7">
        <div class="card shadow-sm"><div class="card-body">
            <h2 class="h5 mb-3">Notes recentes</h2>
            <div class="table-responsive"><table class="table">
                <thead><tr><th>Eleve</th><th>Matiere</th><th>Note</th><th>Trimestre</th></tr></thead>
                <tbody>
                @forelse ($notes as $note)
                    <tr>
                        <td>{{ $note->eleve->nom_complet }}</td>
                        <td>{{ $note->matiere->nom }}</td>
                        <td>{{ $note->valeur }}</td>
                        <td>{{ $note->trimestre }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">Aucune note.</td></tr>
                @endforelse
                </tbody>
            </table></div>
        </div></div>
    </div>
</div>
@endsection
