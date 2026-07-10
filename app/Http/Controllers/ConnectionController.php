<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Services\PrivacyMatchingService;

class ConnectionController extends Controller
{
    public function __construct(private readonly PrivacyMatchingService $privacyMatching)
    {
    }

    public function index()
    {
        $userId = auth()->id();

        $connections = Connection::query()
            ->where('user_one_id', $userId)->orWhere('user_two_id', $userId)
            ->with(['userOne', 'userTwo'])
            ->latest()
            ->paginate(15);

        return view('connections.index', compact('connections'));
    }

    public function redirectToWhatsapp(Connection $connection)
    {
        $user = auth()->user();
        abort_unless(in_array($user->id, [$connection->user_one_id, $connection->user_two_id]), 403);

        $link = $this->privacyMatching->buildWhatsappLink($connection, $user);

        abort_if($link === null, 403, 'Les conditions de confidentialité ne sont plus remplies.');

        $connection->increment('whatsapp_opened_count');
        $connection->update(['whatsapp_last_opened_at' => now()]);

        return redirect()->away($link);
    }
}
