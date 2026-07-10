@extends('layouts.app')

@section('title', 'Mot de passe oublié')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-xl border p-6">
    <h1 class="text-xl font-semibold mb-1">Mot de passe oublié</h1>
    <p class="text-sm text-gray-500 mb-6">
        Indiquez votre adresse email, nous vous enverrons un lien pour créer un nouveau mot de passe.
    </p>

    @if (session('status'))
        <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-3 text-sm">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full rounded-lg border-gray-300 px-3 py-2">
        </div>

        <button type="submit" class="w-full bg-gray-900 text-white rounded-lg py-2.5 font-medium">
            Envoyer le lien de réinitialisation
        </button>
    </form>

    <p class="text-sm text-gray-500 mt-4">
        <a href="{{ route('login') }}" class="underline">Retour à la connexion</a>
    </p>
</div>
@endsection