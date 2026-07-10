<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ConnectionRequest extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'message', 'status', 'responded_at', 'expires_at'];

    protected function casts(): array
    {
        return ['responded_at' => 'datetime', 'expires_at' => 'datetime'];
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function connection(): HasOne
    {
        return $this->hasOne(Connection::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
}