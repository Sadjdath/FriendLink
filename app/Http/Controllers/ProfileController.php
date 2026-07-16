<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $user->load(['interests', 'languages', 'verifications']);

        $existingRequest = auth()->user()
            ->sentConnectionRequests()
            ->where('receiver_id', $user->id)
            ->first();

        return view('profile.show', compact('user', 'existingRequest'));
    }

    public function edit()
    {
        $user = auth()->user()->load('interests', 'languages');
        $interests = Interest::where('is_active', true)->orderBy('category')->get()->groupBy('category');

        return view('profile.edit', compact('user', 'interests'));
    }

    public function update(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:500'],
            'profession' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:4096'],
            'interests' => ['nullable', 'array'],
            'interests.*' => ['integer', 'exists:interests,id'],
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
            $validated['photo_moderation_status'] = 'pending';
        }

        $request->user()->update(collect($validated)->except('interests')->toArray());

        if ($request->has('interests')) {
            $request->user()->interests()->sync($validated['interests'] ?? []);
        }

        return back()->with('status', 'Profil mis à jour.');
    }
}
