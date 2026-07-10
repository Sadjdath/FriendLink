<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone', 'password',
        'birthdate', 'gender', 'bio', 'profession',
        'avatar_path', 'city', 'country', 'latitude', 'longitude',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'last_active_at' => 'datetime',
            'birthdate' => 'date',
            'password' => 'hashed',
        ];
    }

    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(Interest::class);
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class)->withPivot('level');
    }

    public function privacySetting(): HasOne
    {
        return $this->hasOne(PrivacySetting::class);
    }

    public function verifications(): HasMany
    {
        return $this->hasMany(Verification::class);
    }

    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class)->latestOfMany();
    }

    public function sentConnectionRequests(): HasMany
    {
        return $this->hasMany(ConnectionRequest::class, 'sender_id');
    }

    public function receivedConnectionRequests(): HasMany
    {
        return $this->hasMany(ConnectionRequest::class, 'receiver_id');
    }

    public function blockedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'blocks', 'user_id', 'blocked_user_id');
    }

    public function reportsMade(): HasMany
    {
        return $this->hasMany(Report::class, 'reporter_id');
    }

    public function isFullyVerified(): bool
    {
        return $this->verifications()
            ->whereIn('type', ['phone', 'photo'])
            ->where('status', 'verified')
            ->count() === 2;
    }

    public function hasBlocked(User $other): bool
    {
        return $this->blockedUsers()->where('blocked_user_id', $other->id)->exists();
    }
}
