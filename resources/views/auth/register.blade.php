@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
    <h1 class="text-xl font-bold mb-1">Créer votre compte</h1>
    <p class="text-sm text-slate-500 mb-6">Rejoignez FriendLink en toute confiance.</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1.5">Nom complet</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1.5">Pseudo</label>
            <input type="text" name="username" value="{{ old('username') }}" required
                   placeholder="ex: leo_voyage" pattern="[a-zA-Z0-9_-]+"
                   class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
            <p class="text-xs text-slate-400 mt-1.5">Visible par les autres utilisateurs, sans espaces ni caractères spéciaux.</p>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1.5">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1.5">Téléphone (WhatsApp)</label>
            <input type="tel" name="phone" value="{{ old('phone') }}" required
                   placeholder="+229 00 00 00 00"
                   class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1.5">Mot de passe</label>
            <input type="password" name="password" required
                   class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1.5">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" required
                   class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
        </div>

        <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white rounded-xl py-2.5 font-semibold transition shadow-sm shadow-brand-600/20">
            Créer mon compte
        </button>
    </form>

    <p class="text-sm text-slate-500 mt-6 text-center">
        Déjà inscrit ? <a href="{{ route('login') }}" class="text-brand-700 font-medium underline">Se connecter</a>
    </p>
</div>
@endsection