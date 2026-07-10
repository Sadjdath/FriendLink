@extends('layouts.app')

@section('title', 'Demandes reçues')

@section('content')
<h1 class="text-xl font-semibold mb-6">Demandes de connexion reçues</h1>

<div class="grid gap-3">
    @forelse ($requests as $request)
        <div class="bg-white border rounded-xl p-4">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-12 h-12 rounded-full bg-gray-200 shrink-0"></div>
                <div class="flex-1">
                    <p class="font-medium">{{ $request->sender->name }}</p>
                    <p class="text-sm text-gray-500">{{ $request->sender->interests->pluck('name')->take(3)->join(' · ') }}</p>
                </div>
            </div>

            @if ($request->message)
                <p class="text-sm text-gray-700 bg-gray-50 rounded-lg px-3 py-2 mb-3">
                    "{{ $request->message }}"
                </p>
            @endif

            <div class="flex gap-2">
                <form method="POST" action="{{ route('requests.accept', $request) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="bg-gray-900 text-white rounded-lg px-4 py-2 text-sm font-medium">
                        Accepter
                    </button>
                </form>
                <form method="POST" action="{{ route('requests.decline', $request) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="border rounded-lg px-4 py-2 text-sm font-medium">
                        Refuser
                    </button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-gray-500 text-sm">Aucune demande en attente.</p>
    @endforelse
</div>

<div class="mt-6">{{ $requests->links() }}</div>
@endsection