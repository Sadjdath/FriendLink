<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reported_id' => ['required', 'integer', 'exists:users,id'],
            'reason' => ['required', 'in:faux_profil,contenu_inapproprie,harcelement,spam,arnaque,mineur,autre'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
