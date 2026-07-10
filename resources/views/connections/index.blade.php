@extends('layouts.app')

@section('title', 'Mes connexions')

@section('content')
<h1 class="text-xl font-semibold mb-6">Mes connexions</h1>

<div class="grid gap-3">
    @forelse ($connections as $connection)
        @php $other = $connection->otherUser(auth()->user()); @endphp
        <div class="flex items-center justify-between bg-white border rounded-xl p-4">
            <div>
                <p class="font-medium">{{ $other->name }}</p>
                <p class="text-xs text-gray-500">Statut : {{ $connection->whatsapp_status }}</p>
            </div>

            @if ($connection->whatsapp_status === 'unlocked')
                <a href="{{ route('connections.whatsapp', $connection) }}" target="_blank"
                   class="bg-[#25D366] text-[#04342C] rounded-lg px-4 py-2 text-sm font-medium">
                    Discuter sur WhatsApp
                </a>
            @else
                <span class="text-xs text-gray-400">Conditions non réunies</span>
            @endif
        </div>
    @empty
        <p class="text-gray-500 text-sm">Aucune connexion pour le moment.</p>
    @endforelse
</div>

<div class="mt-6">{{ $connections->links() }}</div>
@endsection