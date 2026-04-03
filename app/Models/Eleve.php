<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Eleve extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'matricule',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'nationalite',
        'adresse',
        'classe_id',
        'parent_id',
        'annee_inscription',
    ];

    protected $casts = [
        'date_naissance' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function scopeActif($query)
    {
        return $query->whereHas('user', fn ($userQuery) => $userQuery->where('actif', true));
    }

    public function getNomCompletAttribute(): string
    {
        return trim(($this->user->prenom ?? '') . ' ' . ($this->user->nom ?? ''));
    }

    public function moyenneGenerale(string $trimestre, int $annee): float
    {
        $notes = $this->notes()
            ->with('matiere')
            ->where('trimestre', $trimestre)
            ->where('annee_scolaire', $annee)
            ->get();

        if ($notes->isEmpty()) {
            return 0.0;
        }

        $totalCoeff = $notes->sum('matiere.coefficient');
        $totalPoints = $notes->sum(fn ($note) => $note->valeur * $note->matiere->coefficient);

        return $totalCoeff > 0 ? round($totalPoints / $totalCoeff, 2) : 0.0;
    }
}
