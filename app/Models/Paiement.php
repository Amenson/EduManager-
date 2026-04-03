<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'eleve_id',
        'montant',
        'type',
        'statut',
        'date_paiement',
        'mode_paiement',
        'reference',
        'recu_par',
    ];

    protected $casts = [
        'date_paiement' => 'datetime',
    ];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }

    public function comptable()
    {
        return $this->belongsTo(User::class, 'recu_par');
    }
}
