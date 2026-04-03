@extends('layouts.app')

@section('title', 'Mes classes')

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <h1 class="h4 mb-3">Mes classes</h1>
    <ul class="list-group">
        @forelse ($classes as $classe)
            <li class="list-group-item d-flex justify-content-between">
                <span>{{ $classe->nom }}</span>
                <span>{{ $classe->eleves_count }} eleves</span>
            </li>
        @empty
            <li class="list-group-item">Aucune classe affectee.</li>
        @endforelse
    </ul>
</div></div>
@endsection
