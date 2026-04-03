{{-- resources/views/admin/eleves/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Gestion des Élèves')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-user-graduate me-2"></i> Liste des Élèves</h2>
    <a href="{{ route('admin.eleves.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Nouvel Élève
    </a>
</div>

{{-- Filtres de recherche --}}
<form method="GET" class="card p-3 mb-4">
    <div class="row g-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control"
                   placeholder="Rechercher un élève..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="classe_id" class="form-select">
                <option value="">Toutes les classes</option>
                @foreach ($classes as $classe)
                    <option value="{{ $classe->id }}"
                        {{ request('classe_id') == $classe->id ? 'selected' : '' }}>
                        {{ $classe->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-outline-primary w-100">Filtrer</button>
        </div>
    </div>
</form>

{{-- Tableau des élèves --}}
<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Matricule</th><th>Nom Complet</th><th>Classe</th>
                    <th>Sexe</th><th>Statut</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($eleves as $eleve)
                <tr>
                    <td><code>{{ $eleve->matricule }}</code></td>
                    <td>{{ $eleve->nom_complet }}</td>
                    <td><span class="badge bg-primary">{{ $eleve->classe->nom }}</span></td>
                    <td>{{ $eleve->sexe === 'M' ? 'Masculin' : 'Féminin' }}</td>
                    <td>
                        <span class="badge {{ $eleve->user->actif ? 'bg-success' : 'bg-danger' }}">
                            {{ $eleve->user->actif ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.eleves.show', $eleve) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.eleves.edit', $eleve) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-4">Aucun élève trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $eleves->links() }}</div>
</div>
@endsection
