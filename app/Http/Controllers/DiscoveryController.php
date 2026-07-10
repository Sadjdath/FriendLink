<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscoveryController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = $request->user();
        $blockedIds = $currentUser->blockedUsers()->pluck('users.id');

        $profiles = \App\Models\User::query()
            ->where('id', '!=', $currentUser->id)
            ->whereNotIn('id', $blockedIds)
            ->where('account_status', 'active')
            ->with(['interests', 'privacySetting'])
            ->when($request->filled('interest'), function ($query) use ($request) {
                $query->whereHas('interests', fn ($q) => $q->where('slug', $request->interest));
            })
            ->when($request->filled('city'), function ($query) use ($request) {
                $query->where('city', $request->city);
            })
            ->whereHas('privacySetting', fn ($q) => $q->whereIn('profile_visibility', ['public', 'shared_interests']))
            ->paginate(12);

        $interests = \App\Models\Interest::where('is_active', true)->get();

        return view('discovery.index', compact('profiles', 'interests'));
    }
}
