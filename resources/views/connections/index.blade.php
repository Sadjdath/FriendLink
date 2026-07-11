@extends('layouts.app')

@section('title', 'Mes connexions')

@section('content')
<h1 class="text-xl font-bold mb-6">Mes connexions</h1>

<div class="grid gap-3">
    @forelse ($connections as $connection)
        @php $other = $connection->otherUser(auth()->user()); @endphp
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white border border-slate-200 rounded-2xl p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-brand-200 to-brand-400 shrink-0"></div>
                <div>
                    <p class="font-semibold">{{ $other->username }}</p>
                    <p class="text-xs text-slate-500">Statut : {{ $connection->whatsapp_status }}</p>
                </div>
            </div>

            @if ($connection->whatsapp_status === 'unlocked')
                <a href="{{ route('connections.whatsapp', $connection) }}" target="_blank"
                   class="bg-[#25D366] hover:brightness-95 text-[#04342C] rounded-xl px-4 py-2.5 text-sm font-semibold transition">
                    Discuter sur WhatsApp
                </a>
            @else
                <span class="text-xs text-slate-400 bg-slate-50 rounded-full px-3 py-1.5">Conditions non réunies</span>
            @endif
        </div>
    @empty
        <div class="text-center bg-white border border-slate-200 rounded-2xl p-10">
            <p class="text-slate-500 text-sm">Aucune connexion pour le moment.</p>
        </div>
    @endforelse
</div>

<div class="mt-6">{{ $connections->links() }}</div>
@endsection