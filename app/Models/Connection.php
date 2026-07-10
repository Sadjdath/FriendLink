<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Connection extends Model
{
    protected $fillable = [
        'connection_request_id', 'user_one_id', 'user_two_id',
        'whatsapp_status', 'whatsapp_unlocked_at',
        'whatsapp_opened_count', 'whatsapp_last_opened_at',
    ];

    protected function casts(): array
    {
        return [
            'whatsapp_unlocked_at' => 'datetime',
            'whatsapp_last_opened_at' => 'datetime',
        ];
    }

    public function connectionRequest(): BelongsTo
    {
        return $this->belongsTo(ConnectionRequest::class);
    }

    public function userOne(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_one_id');
    }

    public function userTwo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_two_id');
    }

    public function otherUser(User $current): User
    {
        return $this->user_one_id === $current->id ? $this->userTwo : $this->userOne;
    }
}
