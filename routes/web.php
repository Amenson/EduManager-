<?php

use App\Http\Controllers\Admin\ClasseController as AdminClasseController;
use App\Http\Controllers\Admin\EleveController as AdminEleveController;
use App\Http\Controllers\Admin\EmploiController as AdminEmploiController;
use App\Http\Controllers\Admin\MatiereController as AdminMatiereController;
use App\Http\Controllers\Admin\RapportController as AdminRapportController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Comptable\PaiementController;
use App\Http\Controllers\Comptable\RapportController as ComptableRapportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Eleve\BulletinController;
use App\Http\Controllers\Eleve\EmploiController as EleveEmploiController;
use App\Http\Controllers\Eleve\NoteController as EleveNoteController;
use App\Http\Controllers\Enseignant\AbsenceController as EnseignantAbsenceController;
use App\Http\Controllers\Enseignant\ClasseController as EnseignantClasseController;
use App\Http\Controllers\Enseignant\NoteController as EnseignantNoteController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('eleves', AdminEleveController::class)->parameters(['eleves' => 'eleve']);
        Route::resource('classes', AdminClasseController::class)->except(['show'])->parameters(['classes' => 'classe']);
        Route::resource('matieres', AdminMatiereController::class)->except(['show']);
        Route::resource('utilisateurs', AdminUserController::class)->except(['show']);
        Route::get('emploi-du-temps', [AdminEmploiController::class, 'index'])->name('edt');
        Route::post('emploi-du-temps', [AdminEmploiController::class, 'store'])->name('edt.store');
        Route::get('rapports', [AdminRapportController::class, 'index'])->name('rapports');
    });

    Route::middleware('role:enseignant')->prefix('enseignant')->name('enseignant.')->group(function () {
        Route::get('mes-classes', [EnseignantClasseController::class, 'index'])->name('classes');
        Route::get('notes', [EnseignantNoteController::class, 'index'])->name('notes');
        Route::post('notes', [EnseignantNoteController::class, 'saisirNotes'])->name('notes.store');
        Route::get('absences', [EnseignantAbsenceController::class, 'index'])->name('absences');
        Route::post('absences', [EnseignantAbsenceController::class, 'store'])->name('absences.store');
    });

    Route::middleware('role:eleve')->prefix('eleve')->name('eleve.')->group(function () {
        Route::get('notes', [EleveNoteController::class, 'index'])->name('notes');
        Route::get('bulletin/{trimestre}', [BulletinController::class, 'show'])->name('bulletin');
        Route::get('emploi-du-temps', [EleveEmploiController::class, 'index'])->name('edt');
    });

    Route::middleware('role:comptable')->prefix('comptable')->name('comptable.')->group(function () {
        Route::resource('paiements', PaiementController::class)->only(['index', 'create', 'store', 'show']);
        Route::get('rapport-financier', [ComptableRapportController::class, 'index'])->name('rapport');
        Route::get('paiements/{paiement}/recu', [PaiementController::class, 'genererRecu'])->name('paiements.recu');
    });
});
