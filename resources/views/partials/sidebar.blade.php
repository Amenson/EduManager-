<aside class="col-lg-2 bg-white border-end min-vh-100 p-3">
    <div class="list-group list-group-flush">
        <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">Tableau de bord</a>

        @if (auth()->user()->isAdmin())
            <a href="{{ route('admin.eleves.index') }}" class="list-group-item list-group-item-action">Eleves</a>
            <a href="{{ route('admin.classes.index') }}" class="list-group-item list-group-item-action">Classes</a>
            <a href="{{ route('admin.matieres.index') }}" class="list-group-item list-group-item-action">Matieres</a>
            <a href="{{ route('admin.utilisateurs.index') }}" class="list-group-item list-group-item-action">Utilisateurs</a>
            <a href="{{ route('admin.edt') }}" class="list-group-item list-group-item-action">Emploi du temps</a>
            <a href="{{ route('admin.rapports') }}" class="list-group-item list-group-item-action">Rapports</a>
        @endif

        @if (auth()->user()->isEnseignant())
            <a href="{{ route('enseignant.classes') }}" class="list-group-item list-group-item-action">Mes classes</a>
            <a href="{{ route('enseignant.notes') }}" class="list-group-item list-group-item-action">Notes</a>
            <a href="{{ route('enseignant.absences') }}" class="list-group-item list-group-item-action">Absences</a>
        @endif

        @if (auth()->user()->isEleve())
            <a href="{{ route('eleve.notes') }}" class="list-group-item list-group-item-action">Mes notes</a>
            <a href="{{ route('eleve.bulletin', 'T1') }}" class="list-group-item list-group-item-action">Bulletin T1</a>
            <a href="{{ route('eleve.edt') }}" class="list-group-item list-group-item-action">Mon emploi du temps</a>
        @endif

        @if (auth()->user()->isComptable())
            <a href="{{ route('comptable.paiements.index') }}" class="list-group-item list-group-item-action">Paiements</a>
            <a href="{{ route('comptable.rapport') }}" class="list-group-item list-group-item-action">Rapport financier</a>
        @endif
    </div>
</aside>
