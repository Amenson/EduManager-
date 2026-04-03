@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <h1 class="h4 mb-4">{{ $title }}</h1>
    <form method="POST" action="{{ $action }}">
        @csrf
        @if ($method !== 'POST') @method($method) @endif
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Nom</label><input class="form-control" name="nom" value="{{ old('nom', $user->nom) }}" required></div>
            <div class="col-md-6"><label class="form-label">Prenom</label><input class="form-control" name="prenom" value="{{ old('prenom', $user->prenom) }}" required></div>
            <div class="col-md-6"><label class="form-label">Email</label><input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required></div>
            <div class="col-md-6"><label class="form-label">Telephone</label><input class="form-control" name="telephone" value="{{ old('telephone', $user->telephone) }}"></div>
            <div class="col-md-6"><label class="form-label">Role</label><select class="form-select" name="role" required>@foreach (['admin', 'directeur', 'enseignant', 'eleve', 'parent', 'comptable'] as $role)<option value="{{ $role }}" @selected(old('role', $user->role) === $role)>{{ $role }}</option>@endforeach</select></div>
            <div class="col-md-6"><label class="form-label">Mot de passe</label><input type="password" class="form-control" name="password" {{ $method === 'POST' ? 'required' : '' }}></div>
        </div>
        <div class="mt-4"><button class="btn btn-primary">Enregistrer</button></div>
    </form>
</div></div>
@endsection
