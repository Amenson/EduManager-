<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Paiement;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_eleves' => Eleve::count(),
            'total_classes' => Classe::count(),
            'absences_semaine' => Absence::where('date', '>=', Carbon::now()->startOfWeek())->count(),
            'paiements_mois' => Paiement::where('statut', 'paye')
                ->whereMonth('date_paiement', now()->month)
                ->sum('montant'),
        ];

        $absencesParClasse = Classe::withCount(['eleves as absences_count' => function ($query) {
            $query->join('absences', 'eleves.id', '=', 'absences.eleve_id')
                ->where('absences.date', '>=', Carbon::now()->startOfMonth());
        }])->orderByDesc('absences_count')->limit(6)->get();

        $monthExpression = DB::connection()->getDriverName() === 'sqlite'
            ? "CAST(strftime('%m', date_paiement) AS INTEGER)"
            : 'MONTH(date_paiement)';

        $paiementsParMois = Paiement::selectRaw($monthExpression . ' as mois, SUM(montant) as total')
            ->where('statut', 'paye')
            ->whereYear('date_paiement', now()->year)
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        $recentPaiements = Paiement::with('eleve.user')
            ->where('statut', 'paye')
            ->latest('date_paiement')
            ->limit(5)
            ->get();

        $recentAbsences = Absence::with('eleve.user')
            ->latest('date')
            ->limit(5)
            ->get();

        $quickLinks = $this->quickLinks();

        return view('dashboard', compact(
            'stats',
            'absencesParClasse',
            'paiementsParMois',
            'recentPaiements',
            'recentAbsences',
            'quickLinks'
        ));
    }

    private function quickLinks(): array
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return [
                ['label' => 'Nouvel eleve', 'route' => route('admin.eleves.create')],
                ['label' => 'Nouvelle classe', 'route' => route('admin.classes.create')],
                ['label' => 'Nouvelle matiere', 'route' => route('admin.matieres.create')],
                ['label' => 'Rapports', 'route' => route('admin.rapports')],
            ];
        }

        if ($user->isEnseignant()) {
            return [
                ['label' => 'Saisir des notes', 'route' => route('enseignant.notes')],
                ['label' => 'Absences', 'route' => route('enseignant.absences')],
                ['label' => 'Mes classes', 'route' => route('enseignant.classes')],
            ];
        }

        if ($user->isComptable()) {
            return [
                ['label' => 'Nouveau paiement', 'route' => route('comptable.paiements.create')],
                ['label' => 'Historique paiements', 'route' => route('comptable.paiements.index')],
                ['label' => 'Rapport financier', 'route' => route('comptable.rapport')],
            ];
        }

        if ($user->isEleve()) {
            return [
                ['label' => 'Mes notes', 'route' => route('eleve.notes')],
                ['label' => 'Mon bulletin', 'route' => route('eleve.bulletin', 'T1')],
                ['label' => 'Mon emploi du temps', 'route' => route('eleve.edt')],
            ];
        }

        return [
            ['label' => 'Tableau de bord', 'route' => route('dashboard')],
        ];
    }
}
