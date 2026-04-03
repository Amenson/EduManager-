@extends('layouts.app')

@section('title', 'Matieres')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0">Matieres</h1>
    <a class="btn btn-primary" href="{{ route('admin.matieres.create') }}">Nouvelle matiere</a>
</div>
<div class="card shadow-sm"><div class="table-responsive"><table class="table mb-0">
    <thead><tr><th>Nom</th><th>Code</th><th>Coefficient</th><th>Volume horaire</th><th></th></tr></thead>
    <tbody>
    @forelse ($matieres as $matiere)
        <tr>
            <td>{{ $matiere->nom }}</td>
            <td>{{ $matiere->code }}</td>
            <td>{{ $matiere->coefficient }}</td>
            <td>{{ $matiere->volume_horaire }}</td>
            <td class="text-end"><a class="btn btn-sm btn-warning" href="{{ route('admin.matieres.edit', $matiere) }}">Modifier</a></td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center">Aucune matiere.</td></tr>
    @endforelse
    </tbody>
</table></div></div>
<div class="mt-3">{{ $matieres->links() }}</div>
@endsection
