<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = ['nom', 'prenom', 'email', 'password', 'role', 'telephone', 'photo'];
    protected $hidden   = ['password', 'remember_token'];
    protected $casts    = ['actif' => 'boolean'];

    // Vérification des rôles
    public function isAdmin()      { return $this->role === 'admin'; }
    public function isEnseignant() { return $this->role === 'enseignant'; }
    public function isEleve()      { return $this->role === 'eleve'; }
    public function isParent()     { return $this->role === 'parent'; }
    public function isComptable()  { return $this->role === 'comptable'; }

    public function eleve()  { return $this->hasOne(Eleve::class); }
    public function enfants(){ return $this->hasMany(Eleve::class, 'parent_id'); }
    public function classesTitularisees(){ return $this->hasMany(Classe::class, 'titulaire_id'); }
    public function paiementsRecus(){ return $this->hasMany(Paiement::class, 'recu_par'); }

    public function displayName(): string
    {
        return trim($this->prenom . ' ' . $this->nom);
    }

    public function landingRoute(): string
    {
        return match ($this->role) {
            'admin', 'directeur' => 'dashboard',
            'enseignant' => 'enseignant.notes',
            'eleve' => 'eleve.notes',
            'comptable' => 'comptable.paiements.index',
            'parent' => 'dashboard',
            default => 'dashboard',
        };
    }
}
