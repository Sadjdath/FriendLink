<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePrivacySettingsRequest;
use App\Models\Interest;
use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    public function interests()
    {
        $interests = Interest::where('is_active', true)->orderBy('category')->get()->groupBy('category');

        return view('onboarding.interests', compact('interests'));
    }

    public function storeInterests(Request $request)
    {
        $validated = $request->validate([
            'interests' => ['required', 'array', 'min:3'],
            'interests.*' => ['integer', 'exists:interests,id'],
        ], [
            'interests.min' => 'Sélectionnez au moins 3 centres d\'intérêt.',
        ]);

        $request->user()->interests()->sync($validated['interests']);

        return redirect()->route('onboarding.privacy');
    }

    public function privacy()
    {
        $settings = auth()->user()->privacySetting;

        return view('onboarding.privacy', compact('settings'));
    }

    public function storePrivacy(UpdatePrivacySettingsRequest $request)
    {
        $request->user()->privacySetting()->update([
            ...$request->validated(),
            'requires_manual_whatsapp_confirmation' => $request->boolean('requires_manual_whatsapp_confirmation'),
        ]);

        return redirect()->route('discovery.index')->with('status', 'Bienvenue sur FriendLink !');
    }
}
