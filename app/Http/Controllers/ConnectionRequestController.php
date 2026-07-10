<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConnectionRequestRequest;
use App\Models\Connection;
use App\Models\ConnectionRequest;
use App\Services\PrivacyMatchingService;
use Illuminate\Support\Facades\DB;

class ConnectionRequestController extends Controller
{
    public function __construct(private readonly PrivacyMatchingService $privacyMatching)
    {
    }

    public function store(StoreConnectionRequestRequest $request)
    {
        $sender = $request->user();
        $receiver = \App\Models\User::findOrFail($request->receiver_id);

        if (! $this->privacyMatching->canSenderContactReceiver($sender, $receiver)) {
            return back()->withErrors(['receiver_id' => "Les conditions de confidentialité de cet utilisateur ne sont pas remplies."]);
        }

        ConnectionRequest::updateOrCreate(
            ['sender_id' => $sender->id, 'receiver_id' => $receiver->id],
            ['message' => $request->message, 'status' => 'pending', 'expires_at' => now()->addDays(14)]
        );

        return back()->with('status', 'Demande envoyée.');
    }

    public function accept(ConnectionRequest $connectionRequest)
    {
        abort_unless($connectionRequest->receiver_id === auth()->id(), 403);

        DB::transaction(function () use ($connectionRequest) {
            $connectionRequest->update(['status' => 'accepted', 'responded_at' => now()]);

            $connection = Connection::create([
                'connection_request_id' => $connectionRequest->id,
                'user_one_id' => $connectionRequest->sender_id,
                'user_two_id' => $connectionRequest->receiver_id,
            ]);

            $status = $this->privacyMatching->resolveWhatsappStatus($connection);
            $connection->update([
                'whatsapp_status' => $status,
                'whatsapp_unlocked_at' => $status === 'unlocked' ? now() : null,
            ]);
        });

        return back()->with('status', 'Connexion acceptée.');
    }

    public function decline(ConnectionRequest $connectionRequest)
    {
        abort_unless($connectionRequest->receiver_id === auth()->id(), 403);

        $connectionRequest->update(['status' => 'declined', 'responded_at' => now()]);

        return back()->with('status', 'Demande refusée.');
    }
}