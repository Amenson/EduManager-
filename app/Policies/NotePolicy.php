<?php
// app/Policies/NotePolicy.php
namespace App\Policies;

use App\Models\{User, Note};

class NotePolicy {
    // Seul l'enseignant qui a créé la note ou un admin peut la modifier
    public function update(User $user, Note $note): bool {
        return $user->isAdmin() || $note->enseignant_id === $user->id;
    }

    // Un élève ne peut voir que ses propres notes
    public function view(User $user, Note $note): bool {
        if ($user->isAdmin() || $user->isEnseignant()) return true;
        if ($user->isEleve()) return $note->eleve->user_id === $user->id;
        if ($user->isParent()) return $note->eleve->parent_id === $user->id;
        return false;
    }
}
