@extends('layouts.app')

@section('title', 'Nouveau paiement')

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <h1 class="h4 mb-4">Nouveau paiement</h1>
    <form method="POST" action="{{ route('comptable.paiements.store') }}">
        @csrf
        <div class="row g-3">
            <div class="col-12"><label class="form-label">Eleve</label><select class="form-select" name="eleve_id">@foreach ($eleves as $eleve)<option value="{{ $eleve->id }}">{{ $eleve->matricule }} - {{ $eleve->nom_complet }}</option>@endforeach</select></div>
            <div class="col-md-4"><label class="form-label">Montant</label><input type="number" class="form-control" name="montant" required></div>
            <div class="col-md-4"><label class="form-label">Type</label><select class="form-select" name="type"><option value="inscription">Inscription</option><option value="scolarite">Scolarite</option><option value="cantine">Cantine</option><option value="autre">Autre</option></select></div>
            <div class="col-md-4"><label class="form-label">Mode</label><input class="form-control" name="mode_paiement" required></div>
        </div>
        <div class="mt-4"><button class="btn btn-primary">Enregistrer</button></div>
    </form>
</div></div>
@endsection
