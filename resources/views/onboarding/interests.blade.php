@extends('layouts.app')

@section('title', 'Vos centres d\'intérêt')

@section('content')
<div class="bg-white rounded-xl border p-6">
    <h1 class="text-xl font-semibold mb-1">Vos centres d'intérêt</h1>
    <p class="text-sm text-gray-500 mb-6">Sélectionnez au moins 3 intérêts pour affiner vos suggestions.</p>

    <form method="POST" action="{{ route('onboarding.interests') }}">
        @csrf

        @foreach ($interests as $category => $items)
            <div class="mb-5">
                <p class="text-xs uppercase tracking-wide text-gray-400 mb-2">{{ $category }}</p>
                <div class="flex flex-wrap gap-2">
                    @foreach ($items as $interest)
                        <label class="cursor-pointer">
                            <input type="checkbox" name="interests[]" value="{{ $interest->id }}" class="peer sr-only">
                            <span class="inline-block px-3 py-1.5 rounded-full border text-sm peer-checked:bg-gray-900 peer-checked:text-white">
                                {{ $interest->name }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach

        <button type="submit" class="mt-4 bg-gray-900 text-white rounded-lg px-6 py-2.5 font-medium">
            Continuer
        </button>
    </form>
</div>
@endsection