@extends('layouts.app')

@section('title', 'Classes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0">Classes</h1>
    <a class="btn btn-primary" href="{{ route('admin.classes.create') }}">Nouvelle classe</a>
</div>
<div class="card shadow-sm"><div class="table-responsive"><table class="table mb-0">
    <thead><tr><th>Nom</th><th>Niveau</th><th>Capacite</th><th>Titulaire</th><th></th></tr></thead>
    <tbody>
    @forelse ($classes as $classe)
        <tr>
            <td>{{ $classe->nom }}</td>
            <td>{{ $classe->niveau }}</td>
            <td>{{ $classe->capacite }}</td>
            <td>{{ $classe->titulaire?->prenom }} {{ $classe->titulaire?->nom }}</td>
            <td class="text-end"><a class="btn btn-sm btn-warning" href="{{ route('admin.classes.edit', $classe) }}">Modifier</a></td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center">Aucune classe.</td></tr>
    @endforelse
    </tbody>
</table></div></div>
<div class="mt-3">{{ $classes->links() }}</div>
@endsection
