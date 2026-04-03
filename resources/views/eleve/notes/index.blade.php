@extends('layouts.app')

@section('title', 'Mes notes')

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <h1 class="h4 mb-3">Mes notes</h1>
    <div class="table-responsive"><table class="table">
        <thead><tr><th>Matiere</th><th>Valeur</th><th>Trimestre</th><th>Type</th></tr></thead>
        <tbody>
        @forelse ($notes as $note)
            <tr>
                <td>{{ $note->matiere->nom }}</td>
                <td>{{ $note->valeur }}</td>
                <td>{{ $note->trimestre }}</td>
                <td>{{ $note->type_evaluation }}</td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center">Aucune note disponible.</td></tr>
        @endforelse
        </tbody>
    </table></div>
</div></div>
@endsection
