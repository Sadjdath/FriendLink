<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrivacySettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'profile_visibility' => ['required', 'in:public,shared_interests,invite_only'],
            'who_can_contact' => ['required', 'in:everyone,verified_only,shared_interests'],
            'requires_manual_whatsapp_confirmation' => ['sometimes', 'boolean'],
            'max_distance_km' => ['nullable', 'integer', 'min:1', 'max:500'],
            'min_contact_age' => ['nullable', 'integer', 'min:18', 'max:99'],
            'max_contact_age' => ['nullable', 'integer', 'min:18', 'max:99', 'gte:min_contact_age'],
        ];
    }
}
