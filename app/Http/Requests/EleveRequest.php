<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EleveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        $userId = $this->route('eleve')?->user_id;

        return [
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'date_naissance' => 'required|date|before:-5 years',
            'lieu_naissance' => 'required|string|max:100',
            'sexe' => 'required|in:M,F',
            'classe_id' => 'required|exists:classes,id',
            'parent_id' => 'nullable|exists:users,id',
            'nationalite' => 'nullable|string|max:100',
            'adresse' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de l eleve est obligatoire.',
            'email.unique' => 'Cette adresse email est deja utilisee.',
            'date_naissance.before' => 'L eleve doit avoir au moins 5 ans.',
            'classe_id.exists' => 'La classe selectionnee n existe pas.',
        ];
    }
}
