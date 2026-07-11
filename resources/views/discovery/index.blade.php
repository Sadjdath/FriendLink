@extends('layouts.app')

@section('title', 'Découverte')

@section('content')
<h1 class="text-xl font-bold mb-1">Découverte</h1>
<p class="text-sm text-slate-500 mb-6">Trouvez des personnes qui partagent vos centres d'intérêt.</p>

<form method="GET" action="{{ route('discovery.index') }}" class="mb-6">
    <label class="block text-sm font-medium mb-1.5" for="interest-filter">Filtrer par centre d'intérêt</label>
    <select id="interest-filter" name="interest" onchange="this.form.submit()"
            class="w-full sm:w-64 rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
        <option value="">Tous les intérêts</option>
        @foreach ($interests as $interest)
            <option value="{{ $interest->slug }}" @selected(request('interest') === $interest->slug)>
                {{ $interest->name }}
            </option>
        @endforeach
    </select>
</form>

<div class="grid gap-3">
    @forelse ($profiles as $profile)
        <a href="{{ route('profile.show', $profile) }}"
           class="flex items-center gap-4 bg-white border border-slate-200 rounded-2xl p-4 hover:border-brand-300 hover:shadow-sm transition">
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-brand-200 to-brand-400 shrink-0"></div>
            <div class="flex-1">
                <p class="font-semibold">{{ $profile->username }}</p>
                <p class="text-sm text-slate-500">{{ $profile->interests->pluck('name')->take(3)->join(' · ') }}</p>
            </div>
            <span class="text-lg">
                @if ($profile->privacySetting?->who_can_contact === 'everyone') 🟢
                @elseif ($profile->privacySetting?->who_can_contact === 'verified_only') 🟡
                @else 🔒
                @endif
            </span>
        </a>
    @empty
        <div class="text-center bg-white border border-slate-200 rounded-2xl p-10">
            <p class="text-slate-500 text-sm">Aucun profil ne correspond à ces filtres pour le moment.</p>
        </div>
    @endforelse
</div>

<div class="mt-6">{{ $profiles->links() }}</div>
@endsection