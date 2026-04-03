<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MatiereRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        $matiereId = $this->route('matiere')?->id;

        return [
            'nom' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', Rule::unique('matieres', 'code')->ignore($matiereId)],
            'coefficient' => ['required', 'numeric', 'min:0.5', 'max:20'],
            'volume_horaire' => ['required', 'integer', 'min:1', 'max:80'],
        ];
    }
}
