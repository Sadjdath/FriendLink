<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrivacySetting extends Model
{
    protected $fillable = [
        'user_id', 'profile_visibility', 'who_can_contact',
        'requires_manual_whatsapp_confirmation', 'max_distance_km',
        'excluded_interest_categories', 'min_contact_age', 'max_contact_age',
    ];

    protected function casts(): array
    {
        return [
            'requires_manual_whatsapp_confirmation' => 'boolean',
            'excluded_interest_categories' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}