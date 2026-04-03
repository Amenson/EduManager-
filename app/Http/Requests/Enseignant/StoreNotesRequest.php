<?php

namespace App\Http\Requests\Enseignant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNotesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isEnseignant();
    }

    public function rules(): array
    {
        return [
            'classe_id' => ['required', 'exists:classes,id'],
            'matiere_id' => ['required', 'exists:matieres,id'],
            'trimestre' => ['required', Rule::in(['T1', 'T2', 'T3'])],
            'notes' => ['required', 'array', 'min:1'],
            'notes.*.valeur' => ['required', 'numeric', 'min:0', 'max:20'],
            'notes.*.type' => ['required', Rule::in(['devoir', 'composition', 'interrogation'])],
            'notes.*.commentaire' => ['nullable', 'string', 'max:500'],
        ];
    }
}
