@extends('layouts.app')

@section('title', 'Nouveau mot de passe')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
    <h1 class="text-xl font-bold mb-6">Créer un nouveau mot de passe</h1>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label class="block text-sm font-medium mb-1.5">Email</label>
            <input type="email" name="email" value="{{ old('email', $email) }}" required
                   class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1.5">Nouveau mot de passe</label>
            <input type="password" name="password" required
                   class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1.5">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" required
                   class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
        </div>

        <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white rounded-xl py-2.5 font-semibold transition shadow-sm shadow-brand-600/20">
            Réinitialiser le mot de passe
        </button>
    </form>
</div>
@endsection