@extends('layouts.app')

@section('title', 'Paiements')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0">Paiements</h1>
    <a class="btn btn-primary" href="{{ route('comptable.paiements.create') }}">Nouveau paiement</a>
</div>
<div class="card shadow-sm"><div class="table-responsive"><table class="table mb-0">
    <thead><tr><th>Reference</th><th>Eleve</th><th>Montant</th><th>Date</th><th></th></tr></thead>
    <tbody>
    @forelse ($paiements as $paiement)
        <tr>
            <td>{{ $paiement->reference }}</td>
            <td>{{ $paiement->eleve->nom_complet }}</td>
            <td>{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
            <td>{{ optional($paiement->date_paiement)->format('d/m/Y H:i') }}</td>
            <td class="text-end"><a class="btn btn-sm btn-outline-primary" href="{{ route('comptable.paiements.show', $paiement) }}">Voir</a></td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center">Aucun paiement.</td></tr>
    @endforelse
    </tbody>
</table></div></div>
<div class="mt-3">{{ $paiements->links() }}</div>
@endsection
