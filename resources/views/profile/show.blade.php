@extends('layouts.app')

@section('title', $user->name)

@section('content')
<div class="bg-white border rounded-xl p-6">
    <div class="h-24 rounded-lg bg-gray-200 mb-4"></div>
    <h1 class="text-xl font-semibold">{{ $user->name }}</h1>
    <p class="text-sm text-gray-500 mb-4">{{ $user->city }} @if($user->profession) · {{ $user->profession }} @endif</p>

    <div class="flex flex-wrap gap-2 mb-4">
        @foreach ($user->interests as $interest)
            <span class="px-3 py-1 rounded-full border text-sm">{{ $interest->name }}</span>
        @endforeach
    </div>

    @if ($user->bio)
        <p class="text-sm text-gray-700 mb-6">{{ $user->bio }}</p>
    @endif

    @if (! $existingRequest)
        <form method="POST" action="{{ route('requests.store') }}" class="mb-3">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $user->id }}">
            <input type="text" name="message" maxlength="280" placeholder="Message d'accroche (optionnel)"
                   class="w-full rounded-lg border-gray-300 px-3 py-2 mb-2 text-sm">
            <button type="submit" class="w-full bg-gray-900 text-white rounded-lg py-2.5 font-medium">
                Se connecter
            </button>
        </form>
    @else
        <p class="text-sm text-gray-500 mb-3">
            Demande {{ $existingRequest->status === 'pending' ? 'en attente de réponse' : $existingRequest->status }}.
        </p>
    @endif

    <div class="flex gap-2 text-sm">
        <form method="POST" action="{{ route('safety.block') }}">
            @csrf
            <input type="hidden" name="blocked_user_id" value="{{ $user->id }}">
            <button type="submit" class="text-gray-500 underline">Bloquer</button>
        </form>

        <details>
            <summary class="text-gray-500 underline cursor-pointer">Signaler</summary>
            <form method="POST" action="{{ route('safety.report') }}" class="mt-2 space-y-2">
                @csrf
                <input type="hidden" name="reported_id" value="{{ $user->id }}">
                <select name="reason" required class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm">
                    <option value="faux_profil">Faux profil</option>
                    <option value="contenu_inapproprie">Contenu inapproprié</option>
                    <option value="harcelement">Harcèlement</option>
                    <option value="spam">Spam</option>
                    <option value="arnaque">Arnaque</option>
                    <option value="mineur">Mineur</option>
                    <option value="autre">Autre</option>
                </select>
                <textarea name="description" maxlength="1000" placeholder="Détails (optionnel)"
                          class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm"></textarea>
                <button type="submit" class="bg-red-600 text-white rounded-lg px-4 py-2 text-sm">Envoyer le signalement</button>
            </form>
        </details>
    </div>
</div>
@endsection