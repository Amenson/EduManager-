<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ClasseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:255'],
            'niveau' => ['required', 'string', 'max:255'],
            'serie' => ['nullable', 'string', 'max:255'],
            'capacite' => ['required', 'integer', 'min:1', 'max:200'],
            'titulaire_id' => ['nullable', 'exists:users,id'],
            'annee_scolaire' => ['required', 'integer', 'digits:4'],
        ];
    }
}
