@extends('layouts.app')

@section('title', 'Vos centres d\'intérêt')

@section('content')
<div class="bg-white rounded-xl border p-6">
    <h1 class="text-xl font-semibold mb-1">Vos centres d'intérêt</h1>
    <p class="text-sm text-gray-500 mb-6">Sélectionnez au moins 3 centres d'intérêt dans la liste.</p>

    <form method="POST" action="{{ route('onboarding.interests') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1" for="interests-select">
                Centres d'intérêt
            </label>
            <select id="interests-select" name="interests[]" multiple size="8"
                    class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm">
                @foreach ($interests as $category => $items)
                    <optgroup label="{{ ucfirst($category) }}">
                        @foreach ($items as $interest)
                            <option value="{{ $interest->id }}">{{ $interest->name }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            <p class="text-xs text-gray-400 mt-1">
                Maintenez Ctrl (ou Cmd sur Mac) enfoncé pour sélectionner plusieurs éléments.
            </p>
        </div>

        <div id="selected-preview" class="flex flex-wrap gap-2 mb-4"></div>

        <button type="submit" class="bg-gray-900 text-white rounded-lg px-6 py-2.5 font-medium">
            Continuer
        </button>
    </form>
</div>

<script>
    const select = document.getElementById('interests-select');
    const preview = document.getElementById('selected-preview');

    function renderSelected() {
        preview.innerHTML = '';
        Array.from(select.selectedOptions).forEach(option => {
            const badge = document.createElement('span');
            badge.className = 'px-3 py-1 rounded-full bg-gray-900 text-white text-xs';
            badge.textContent = option.textContent;
            preview.appendChild(badge);
        });
    }

    select.addEventListener('change', renderSelected);
</script>
@endsection