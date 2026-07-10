@extends('layouts.app')

@section('title', 'Confidentialité')

@section('content')
<div class="bg-white rounded-xl border p-6 max-w-lg mx-auto">
    <h1 class="text-xl font-semibold mb-1">Vos règles, vos conditions</h1>
    <p class="text-sm text-gray-500 mb-6">Modifiable à tout moment depuis vos paramètres.</p>

    <form method="POST" action="{{ request()->routeIs('privacy.edit') ? route('privacy.update') : route('onboarding.privacy') }}" class="space-y-5">
        @csrf
        @if (request()->routeIs('privacy.edit'))
            @method('PATCH')
        @endif

        <div>
            <label class="block text-sm font-medium mb-1">Qui peut voir mon profil</label>
            <select name="profile_visibility" class="w-full rounded-lg border-gray-300 px-3 py-2">
                <option value="public" @selected(old('profile_visibility', $settings->profile_visibility ?? '') === 'public')>Tout le monde</option>
                <option value="shared_interests" @selected(old('profile_visibility', $settings->profile_visibility ?? 'shared_interests') === 'shared_interests')>Personnes aux intérêts communs</option>
                <option value="invite_only" @selected(old('profile_visibility', $settings->profile_visibility ?? '') === 'invite_only')>Sur invitation uniquement</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Qui peut m'envoyer une demande</label>
            <select name="who_can_contact" class="w-full rounded-lg border-gray-300 px-3 py-2">
                <option value="everyone" @selected(old('who_can_contact', $settings->who_can_contact ?? '') === 'everyone')>Tout le monde</option>
                <option value="verified_only" @selected(old('who_can_contact', $settings->who_can_contact ?? 'verified_only') === 'verified_only')>Profils vérifiés uniquement</option>
                <option value="shared_interests" @selected(old('who_can_contact', $settings->who_can_contact ?? '') === 'shared_interests')>Intérêts communs uniquement</option>
            </select>
        </div>

        <label class="flex items-center gap-3">
            <input type="checkbox" name="requires_manual_whatsapp_confirmation" value="1"
                   @checked(old('requires_manual_whatsapp_confirmation', $settings->requires_manual_whatsapp_confirmation ?? true))>
            <span class="text-sm">Exiger une confirmation manuelle avant de partager mon contact WhatsApp</span>
        </label>

        <div>
            <label class="block text-sm font-medium mb-1">Distance maximale (km)</label>
            <input type="number" name="max_distance_km" value="{{ old('max_distance_km', $settings->max_distance_km ?? '') }}"
                   class="w-full rounded-lg border-gray-300 px-3 py-2">
        </div>

        <button type="submit" class="w-full bg-gray-900 text-white rounded-lg py-2.5 font-medium">
            Enregistrer
        </button>
    </form>
</div>
@endsection