@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-xl border p-6">
    <h1 class="text-xl font-semibold mb-1">Créer votre compte</h1>
    <p class="text-sm text-gray-500 mb-6">Rejoignez FriendLink en toute confiance.</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Nom complet</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="w-full rounded-lg border-gray-300 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full rounded-lg border-gray-300 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Téléphone (WhatsApp)</label>
            <input type="tel" name="phone" value="{{ old('phone') }}" required
                   placeholder="+229 00 00 00 00"
                   class="w-full rounded-lg border-gray-300 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Mot de passe</label>
            <input type="password" name="password" required
                   class="w-full rounded-lg border-gray-300 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" required
                   class="w-full rounded-lg border-gray-300 px-3 py-2">
        </div>

        <button type="submit" class="w-full bg-gray-900 text-white rounded-lg py-2.5 font-medium">
            Créer mon compte
        </button>
    </form>

    <p class="text-sm text-gray-500 mt-4">
        Déjà inscrit ? <a href="{{ route('login') }}" class="underline">Se connecter</a>
    </p>
</div>
@endsection