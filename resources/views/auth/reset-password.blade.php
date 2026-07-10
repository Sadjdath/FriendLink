@extends('layouts.app')

@section('title', 'Nouveau mot de passe')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-xl border p-6">
    <h1 class="text-xl font-semibold mb-6">Créer un nouveau mot de passe</h1>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $email) }}" required
                   class="w-full rounded-lg border-gray-300 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Nouveau mot de passe</label>
            <input type="password" name="password" required
                   class="w-full rounded-lg border-gray-300 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" required
                   class="w-full rounded-lg border-gray-300 px-3 py-2">
        </div>

        <button type="submit" class="w-full bg-gray-900 text-white rounded-lg py-2.5 font-medium">
            Réinitialiser le mot de passe
        </button>
    </form>
</div>
@endsection