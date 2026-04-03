@extends('layouts.app')

@section('title', 'Rapports')

@section('content')
<div class="row g-3">
    <div class="col-md-3"><div class="card shadow-sm"><div class="card-body"><div class="text-muted">Eleves</div><div class="fs-3 fw-bold">{{ $stats['eleves'] }}</div></div></div></div>
    <div class="col-md-3"><div class="card shadow-sm"><div class="card-body"><div class="text-muted">Classes</div><div class="fs-3 fw-bold">{{ $stats['classes'] }}</div></div></div></div>
    <div class="col-md-3"><div class="card shadow-sm"><div class="card-body"><div class="text-muted">Absences</div><div class="fs-3 fw-bold">{{ $stats['absences'] }}</div></div></div></div>
    <div class="col-md-3"><div class="card shadow-sm"><div class="card-body"><div class="text-muted">Paiements</div><div class="fs-3 fw-bold">{{ number_format($stats['paiements'], 0, ',', ' ') }} FCFA</div></div></div></div>
</div>
@endsection
