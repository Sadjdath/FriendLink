@extends('layouts.app')

@section('title', 'Demandes reçues')

@section('content')
<h1 class="text-xl font-bold mb-6">Demandes de connexion reçues</h1>

<div class="grid gap-3">
    @forelse ($requests as $request)
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-brand-200 to-brand-400 shrink-0"></div>
                <div class="flex-1">
                    <p class="font-semibold">{{ $request->sender->username }}</p>
                    <p class="text-sm text-slate-500">{{ $request->sender->interests->pluck('name')->take(3)->join(' · ') }}</p>
                </div>
            </div>

            @if ($request->message)
                <p class="text-sm text-slate-700 bg-slate-50 rounded-xl px-4 py-3 mb-4">
                    "{{ $request->message }}"
                </p>
            @endif

            <div class="flex gap-2">
                <form method="POST" action="{{ route('requests.accept', $request) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="bg-brand-600 hover:bg-brand-700 text-white rounded-xl px-4 py-2 text-sm font-semibold transition">
                        Accepter
                    </button>
                </form>
                <form method="POST" action="{{ route('requests.decline', $request) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="border border-slate-200 hover:bg-slate-50 rounded-xl px-4 py-2 text-sm font-semibold transition">
                        Refuser
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="text-center bg-white border border-slate-200 rounded-2xl p-10">
            <p class="text-slate-500 text-sm">Aucune demande en attente.</p>
        </div>
    @endforelse
</div>

<div class="mt-6">{{ $requests->links() }}</div>
@endsection