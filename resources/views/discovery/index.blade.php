@extends('layouts.app')

@section('title', 'Découverte')

@section('content')
<form method="GET" action="{{ route('discovery.index') }}" class="mb-6">
    <label class="block text-sm font-medium mb-1" for="interest-filter">Filtrer par centre d'intérêt</label>
    <select id="interest-filter" name="interest" onchange="this.form.submit()"
            class="w-full sm:w-64 rounded-lg border-gray-300 px-3 py-2 text-sm">
        <option value="">Tous les intérêts</option>
        @foreach ($interests as $interest)
            <option value="{{ $interest->slug }}" @selected(request('interest') === $interest->slug)>
                {{ $interest->name }}
            </option>
        @endforeach
    </select>
</form>

<div class="grid gap-4">
    @forelse ($profiles as $profile)
        <a href="{{ route('profile.show', $profile) }}" class="flex items-center gap-4 bg-white border rounded-xl p-4 hover:border-gray-400">
            <div class="w-12 h-12 rounded-full bg-gray-200 shrink-0"></div>
            <div class="flex-1">
                <p class="font-medium">{{ $profile->name }}</p>
                <p class="text-sm text-gray-500">{{ $profile->interests->pluck('name')->take(3)->join(' · ') }}</p>
            </div>
            <span>
                @if ($profile->privacySetting?->who_can_contact === 'everyone') 🟢
                @elseif ($profile->privacySetting?->who_can_contact === 'verified_only') 🟡
                @else 🔒
                @endif
            </span>
        </a>
    @empty
        <p class="text-gray-500 text-sm">Aucun profil ne correspond à ces filtres pour le moment.</p>
    @endforelse
</div>

<div class="mt-6">{{ $profiles->links() }}</div>
@endsection