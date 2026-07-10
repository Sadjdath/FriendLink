<?php

namespace App\Services;

use App\Models\Connection;
use App\Models\ConnectionRequest;
use App\Models\User;

class PrivacyMatchingService
{
    public function evaluateConnectionRequest(ConnectionRequest $request): bool
    {
        $sender = $request->sender;
        $receiver = $request->receiver;

        if (! $this->canSenderContactReceiver($sender, $receiver)) {
            return false;
        }

        if ($sender->hasBlocked($receiver) || $receiver->hasBlocked($sender)) {
            return false;
        }

        return true;
    }

    public function canSenderContactReceiver(User $sender, User $receiver): bool
    {
        $settings = $receiver->privacySetting;

        if (! $settings) {
            return false;
        }

        return match ($settings->who_can_contact) {
            'everyone' => true,
            'verified_only' => $sender->isFullyVerified(),
            'shared_interests' => $this->hasSharedInterests($sender, $receiver),
            default => false,
        };
    }

    public function hasSharedInterests(User $a, User $b): bool
    {
        $aIds = $a->interests()->pluck('interests.id');
        $bIds = $b->interests()->pluck('interests.id');

        return $aIds->intersect($bIds)->isNotEmpty();
    }

    public function resolveWhatsappStatus(Connection $connection): string
    {
        $userOne = $connection->userOne;
        $userTwo = $connection->userTwo;

        $settingsOne = $userOne->privacySetting;
        $settingsTwo = $userTwo->privacySetting;

        if (! $settingsOne || ! $settingsTwo) {
            return 'locked';
        }

        $requiresManualConfirmation = $settingsOne->requires_manual_whatsapp_confirmation
            || $settingsTwo->requires_manual_whatsapp_confirmation;

        return $requiresManualConfirmation ? 'conditional' : 'unlocked';
    }

    public function buildWhatsappLink(Connection $connection, User $requestingUser): ?string
    {
        if ($this->resolveWhatsappStatus($connection) !== 'unlocked') {
            return null;
        }

        $target = $connection->otherUser($requestingUser);
        $normalizedPhone = preg_replace('/\D/', '', $target->phone);

        return "https://wa.me/{$normalizedPhone}";
    }
}