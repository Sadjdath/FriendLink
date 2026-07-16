<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Models\Block;
use App\Models\Report;
use Illuminate\Http\Request;

class SafetyController extends Controller
{
    public function block(Request $request)
    {
        $validated = $request->validate([
            'blocked_user_id' => ['required', 'integer', 'exists:users,id', 'different:' . $request->user()->id],
            'reason' => ['nullable', 'string', 'max:255'],
        ]);

        Block::firstOrCreate([
            'user_id' => $request->user()->id,
            'blocked_user_id' => $validated['blocked_user_id'],
        ], ['reason' => $validated['reason'] ?? null]);

        return back()->with('status', 'Utilisateur bloqué.');
    }

    public function report(StoreReportRequest $request)
    {
        Report::create([
            'reporter_id' => $request->user()->id,
            ...$request->validated(),
        ]);

        return back()->with('status', 'Signalement envoyé, notre équipe va l\'examiner.');
    }
}
