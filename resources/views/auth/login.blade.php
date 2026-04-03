@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="row justify-content-center align-items-center min-vh-75">
    <div class="col-lg-5 col-md-7">
        <div class="card shadow border-0 overflow-hidden">
            <div class="bg-primary text-white p-4">
                <p class="text-uppercase small fw-semibold mb-2">Espace securise</p>
                <h1 class="h3 mb-2">Connexion a Scolarite</h1>
                <p class="mb-0 text-white-50">Accedez a votre espace pour gerer les operations liees a la vie scolaire.</p>
            </div>

            <div class="card-body p-4 p-lg-5">
                <form method="POST" action="{{ route('login.attempt') }}" class="d-grid gap-3">
                    @csrf
                    <div>
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}" placeholder="exemple@ecole.tg" required>
                    </div>
                    <div>
                        <label class="form-label fw-semibold">Mot de passe</label>
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Votre mot de passe" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="1" id="remember">
                        <label class="form-check-label" for="remember">Garder ma session ouverte</label>
                    </div>
                    <button class="btn btn-primary btn-lg" type="submit">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
