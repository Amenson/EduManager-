<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand fw-semibold" href="{{ route('home') }}">Scolarite</a>

        <div class="d-flex align-items-center gap-2">
            @auth
                <span class="text-white-50 small">
                    {{ auth()->user()->prenom }} {{ auth()->user()->nom }} - {{ auth()->user()->role }}
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-outline-light" type="submit">Deconnexion</button>
                </form>
            @else
                <a class="btn btn-sm btn-outline-light" href="{{ route('login') }}">Connexion</a>
            @endauth
        </div>
    </div>
</nav>
