@extends('layouts.app')

@section('title', 'Mot de passe oublié')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
    <h1 class="text-xl font-bold mb-1">Mot de passe oublié</h1>
    <p class="text-sm text-slate-500 mb-6">
        Indiquez votre adresse email, nous vous enverrons un lien pour créer un nouveau mot de passe.
    </p>

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1.5">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
        </div>

        <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white rounded-xl py-2.5 font-semibold transition shadow-sm shadow-brand-600/20">
            Envoyer le lien de réinitialisation
        </button>
    </form>

    <p class="text-sm text-slate-500 mt-6 text-center">
        <a href="{{ route('login') }}" class="text-brand-700 font-medium underline">Retour à la connexion</a>
    </p>
</div>
@endsection