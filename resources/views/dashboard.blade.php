@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
    <div>
        <p class="text-uppercase text-muted fw-semibold small mb-1">Pilotage</p>
        <h1 class="h3 mb-1">Vue d ensemble de la plateforme</h1>
        <p class="text-muted mb-0">Suivez les indicateurs cles, les mouvements recents et les acces rapides adaptes a votre role.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        @foreach ($quickLinks as $link)
            <a href="{{ $link['route'] }}" class="btn btn-primary">{{ $link['label'] }}</a>
        @endforeach
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100"><div class="card-body">
            <div class="text-muted small">Eleves inscrits</div>
            <div class="display-6 fw-bold">{{ $stats['total_eleves'] }}</div>
        </div></div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100"><div class="card-body">
            <div class="text-muted small">Classes actives</div>
            <div class="display-6 fw-bold">{{ $stats['total_classes'] }}</div>
        </div></div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100"><div class="card-body">
            <div class="text-muted small">Absences cette semaine</div>
            <div class="display-6 fw-bold">{{ $stats['absences_semaine'] }}</div>
        </div></div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100"><div class="card-body">
            <div class="text-muted small">Encaissements du mois</div>
            <div class="display-6 fw-bold">{{ number_format($stats['paiements_mois'], 0, ',', ' ') }}</div>
            <div class="small text-muted">FCFA</div>
        </div></div>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white fw-semibold">Classes les plus impactees par les absences</div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse ($absencesParClasse as $classe)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>{{ $classe->nom }}</span>
                            <span class="badge bg-primary rounded-pill">{{ $classe->absences_count }}</span>
                        </li>
                    @empty
                        <li class="list-group-item px-0">Aucune donnee disponible.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white fw-semibold">Derniers paiements</div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse ($recentPaiements as $paiement)
                        <li class="list-group-item px-0">
                            <div class="d-flex justify-content-between">
                                <strong>{{ $paiement->eleve->nom_complet }}</strong>
                                <span>{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="small text-muted">{{ optional($paiement->date_paiement)->format('d/m/Y H:i') }} | {{ $paiement->reference }}</div>
                        </li>
                    @empty
                        <li class="list-group-item px-0">Aucun paiement recent.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white fw-semibold">Dernieres absences</div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse ($recentAbsences as $absence)
                        <li class="list-group-item px-0">
                            <div class="d-flex justify-content-between">
                                <strong>{{ $absence->eleve->nom_complet }}</strong>
                                <span>{{ optional($absence->date)->format('d/m/Y') }}</span>
                            </div>
                            <div class="small text-muted">{{ $absence->motif ?: 'Absence sans motif precise.' }}</div>
                        </li>
                    @empty
                        <li class="list-group-item px-0">Aucune absence recente.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0 mt-4">
    <div class="card-header bg-white fw-semibold">Evolution des paiements par mois</div>
    <div class="card-body">
        <div class="row g-3">
            @forelse ($paiementsParMois as $ligne)
                <div class="col-md-3 col-sm-6">
                    <div class="border rounded p-3 h-100">
                        <div class="text-muted small">Mois {{ $ligne->mois }}</div>
                        <div class="fs-5 fw-bold">{{ number_format($ligne->total, 0, ',', ' ') }} FCFA</div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="mb-0 text-muted">Aucun paiement enregistre pour cette annee.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
