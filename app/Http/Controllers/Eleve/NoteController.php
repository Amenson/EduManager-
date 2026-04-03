<?php

namespace App\Http\Controllers\Eleve;

use App\Http\Controllers\Controller;
use App\Models\Note;

class NoteController extends Controller
{
    public function index()
    {
        $eleve = auth()->user()->eleve;
        $notes = Note::with('matiere')
            ->where('eleve_id', optional($eleve)->id)
            ->latest()
            ->get();

        return view('eleve.notes.index', compact('eleve', 'notes'));
    }
}
