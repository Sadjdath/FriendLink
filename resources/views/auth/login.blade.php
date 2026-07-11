@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
    <h1 class="text-xl font-bold mb-6">Se connecter</h1>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1.5">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1.5">Mot de passe</label>
            <input type="password" name="password" required
                   class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" name="remember" class="rounded border-slate-300"> Se souvenir de moi
            </label>
            <a href="{{ route('password.request') }}" class="text-sm text-brand-700 font-medium underline">Mot de passe oublié ?</a>
        </div>

        <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white rounded-xl py-2.5 font-semibold transition shadow-sm shadow-brand-600/20">
            Connexion
        </button>
    </form>

    <p class="text-sm text-slate-500 mt-6 text-center">
        Pas encore de compte ? <a href="{{ route('register') }}" class="text-brand-700 font-medium underline">S'inscrire</a>
    </p>
</div>
@endsection