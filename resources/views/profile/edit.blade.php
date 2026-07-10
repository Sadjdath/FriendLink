@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')
<div class="bg-white border rounded-xl p-6 max-w-lg mx-auto">
    <h1 class="text-xl font-semibold mb-6">Mon profil</h1>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PATCH')

        <div>
            <label class="block text-sm font-medium mb-1">Photo de profil</label>
            <input type="file" name="avatar" accept="image/*" class="w-full text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Nom</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full rounded-lg border-gray-300 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Profession</label>
            <input type="text" name="profession" value="{{ old('profession', $user->profession) }}"
                   class="w-full rounded-lg border-gray-300 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Ville</label>
            <input type="text" name="city" value="{{ old('city', $user->city) }}"
                   class="w-full rounded-lg border-gray-300 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Bio</label>
            <textarea name="bio" maxlength="500" rows="4"
                      class="w-full rounded-lg border-gray-300 px-3 py-2">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1" for="interests-select">
                Centres d'intérêt
            </label>
            <select id="interests-select" name="interests[]" multiple size="8"
                    class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm">
                @php $userInterestIds = $user->interests->pluck('id')->toArray(); @endphp
                @foreach ($interests as $category => $items)
                    <optgroup label="{{ ucfirst($category) }}">
                        @foreach ($items as $interest)
                            <option value="{{ $interest->id }}" @selected(in_array($interest->id, $userInterestIds))>
                                {{ $interest->name }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            <p class="text-xs text-gray-400 mt-1">
                Maintenez Ctrl (ou Cmd sur Mac) enfoncé pour sélectionner plusieurs éléments.
            </p>
        </div>

        <div id="selected-preview" class="flex flex-wrap gap-2"></div>

        <button type="submit" class="w-full bg-gray-900 text-white rounded-lg py-2.5 font-medium">
            Enregistrer
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
    renderSelected();
</script>
@endsection