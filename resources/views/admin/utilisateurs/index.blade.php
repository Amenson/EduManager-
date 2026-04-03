@extends('layouts.app')

@section('title', 'Utilisateurs')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0">Utilisateurs</h1>
    <a class="btn btn-primary" href="{{ route('admin.utilisateurs.create') }}">Nouvel utilisateur</a>
</div>
<div class="card shadow-sm"><div class="table-responsive"><table class="table mb-0">
    <thead><tr><th>Nom</th><th>Email</th><th>Role</th><th>Actif</th><th></th></tr></thead>
    <tbody>
    @forelse ($users as $user)
        <tr>
            <td>{{ $user->prenom }} {{ $user->nom }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->actif ? 'Oui' : 'Non' }}</td>
            <td class="text-end"><a class="btn btn-sm btn-warning" href="{{ route('admin.utilisateurs.edit', $user) }}">Modifier</a></td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center">Aucun utilisateur.</td></tr>
    @endforelse
    </tbody>
</table></div></div>
<div class="mt-3">{{ $users->links() }}</div>
@endsection
