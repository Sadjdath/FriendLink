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

        <button type="submit" class="w-full bg-gray-900 text-white rounded-lg py-2.5 font-medium">
            Enregistrer
        </button>
    </form>
</div>
@endsection