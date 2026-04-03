<?php

namespace App\Http\Requests\Comptable;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaiementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->isComptable() || auth()->user()->isAdmin());
    }

    public function rules(): array
    {
        return [
            'eleve_id' => ['required', 'exists:eleves,id'],
            'montant' => ['required', 'numeric', 'min:1', 'max:99999999'],
            'type' => ['required', Rule::in(['inscription', 'scolarite', 'cantine', 'autre'])],
            'mode_paiement' => ['required', 'string', 'max:100'],
        ];
    }
}
