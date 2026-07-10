@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-xl border p-6">
    <h1 class="text-xl font-semibold mb-6">Se connecter</h1>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full rounded-lg border-gray-300 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Mot de passe</label>
            <input type="password" name="password" required
                   class="w-full rounded-lg border-gray-300 px-3 py-2">
        </div>

        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="remember"> Se souvenir de moi
        </label>

        <p class="text-sm">
            <a href="{{ route('password.request') }}" class="underline text-gray-500">Mot de passe oublié ?</a>
        </p>

        <button type="submit" class="w-full bg-gray-900 text-white rounded-lg py-2.5 font-medium">
            Connexion
        </button>
    </form>

    <p class="text-sm text-gray-500 mt-4">
        Pas encore de compte ? <a href="{{ route('register') }}" class="underline">S'inscrire</a>
    </p>
</div>
@endsection