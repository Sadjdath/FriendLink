<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Verification extends Model
{
    protected $fillable = ['user_id', 'type', 'status', 'meta', 'reviewed_by', 'verified_at'];

    protected function casts(): array
    {
        return ['meta' => 'array', 'verified_at' => 'datetime'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
