@extends('layouts.app')

@section('title', 'Découverte')

@section('content')
<div class="flex gap-2 flex-wrap mb-6">
    <a href="{{ route('discovery.index') }}" class="px-3 py-1.5 rounded-full border text-sm {{ request('interest') ? '' : 'bg-gray-900 text-white' }}">Tous</a>
    @foreach ($interests as $interest)
        <a href="{{ route('discovery.index', ['interest' => $interest->slug]) }}"
           class="px-3 py-1.5 rounded-full border text-sm {{ request('interest') === $interest->slug ? 'bg-gray-900 text-white' : '' }}">
            {{ $interest->name }}
        </a>
    @endforeach
</div>

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