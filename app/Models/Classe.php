<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'niveau',
        'serie',
        'capacite',
        'titulaire_id',
        'annee_scolaire',
    ];

    public function titulaire()
    {
        return $this->belongsTo(User::class, 'titulaire_id');
    }

    public function eleves()
    {
        return $this->hasMany(Eleve::class);
    }

    public function emploisDuTemps()
    {
        return $this->hasMany(EmploiDuTemps::class);
    }
}
