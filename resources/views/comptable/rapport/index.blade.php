@extends('layouts.app')

@section('title', 'Rapport financier')

@section('content')
<div class="card shadow-sm mb-4"><div class="card-body">
    <div class="text-muted">Total encaisse</div>
    <div class="display-6 fw-bold">{{ number_format($total, 0, ',', ' ') }} FCFA</div>
</div></div>
<div class="card shadow-sm"><div class="card-body">
    <table class="table">
        <thead><tr><th>Reference</th><th>Eleve</th><th>Montant</th></tr></thead>
        <tbody>
        @forelse ($paiements as $paiement)
            <tr>
                <td>{{ $paiement->reference }}</td>
                <td>{{ $paiement->eleve->nom_complet }}</td>
                <td>{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
            </tr>
        @empty
            <tr><td colspan="3" class="text-center">Aucun paiement.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div>{{ $paiements->links() }}</div>
</div></div>
@endsection
