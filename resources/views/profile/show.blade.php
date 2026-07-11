@extends('layouts.app')

@section('title', $user->username)

@section('content')
<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
    <div class="h-28 bg-gradient-to-br from-brand-400 to-brand-700"></div>
    <div class="p-8 -mt-10">
        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-brand-200 to-brand-400 border-4 border-white mb-4"></div>

        <h1 class="text-xl font-bold">{{ $user->username }}</h1>
        <p class="text-sm text-slate-500 mb-4">{{ $user->city }} @if($user->profession) · {{ $user->profession }} @endif</p>

        <div class="flex flex-wrap gap-2 mb-4">
            @foreach ($user->interests as $interest)
                <span class="px-3 py-1 rounded-full bg-brand-50 border border-brand-200 text-brand-700 text-sm font-medium">{{ $interest->name }}</span>
            @endforeach
        </div>

        @if ($user->bio)
            <p class="text-sm text-slate-700 leading-relaxed mb-6">{{ $user->bio }}</p>
        @endif

        @if (! $existingRequest)
            <form method="POST" action="{{ route('requests.store') }}" class="mb-4">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                <input type="text" name="message" maxlength="280" placeholder="Message d'accroche (optionnel)"
                       class="w-full rounded-xl border border-slate-200 px-4 py-2.5 mb-3 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
                <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white rounded-xl py-2.5 font-semibold transition shadow-sm shadow-brand-600/20">
                    Se connecter
                </button>
            </form>
        @else
            <div class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 mb-4">
                <p class="text-sm text-slate-600">
                    Demande {{ $existingRequest->status === 'pending' ? 'en attente de réponse' : $existingRequest->status }}.
                </p>
            </div>
        @endif

        <div class="flex gap-4 text-sm pt-4 border-t border-slate-100">
            <form method="POST" action="{{ route('safety.block') }}">
                @csrf
                <input type="hidden" name="blocked_user_id" value="{{ $user->id }}">
                <button type="submit" class="text-slate-400 hover:text-slate-600 underline">Bloquer</button>
            </form>

            <details>
                <summary class="text-slate-400 hover:text-slate-600 underline cursor-pointer">Signaler</summary>
                <form method="POST" action="{{ route('safety.report') }}" class="mt-3 space-y-2 max-w-sm">
                    @csrf
                    <input type="hidden" name="reported_id" value="{{ $user->id }}">
                    <select name="reason" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm">
                        <option value="faux_profil">Faux profil</option>
                        <option value="contenu_inapproprie">Contenu inapproprié</option>
                        <option value="harcelement">Harcèlement</option>
                        <option value="spam">Spam</option>
                        <option value="arnaque">Arnaque</option>
                        <option value="mineur">Mineur</option>
                        <option value="autre">Autre</option>
                    </select>
                    <textarea name="description" maxlength="1000" placeholder="Détails (optionnel)"
                              class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm"></textarea>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white rounded-xl px-4 py-2 text-sm font-medium transition">
                        Envoyer le signalement
                    </button>
                </form>
            </details>
        </div>
    </div>
</div>
@endsection