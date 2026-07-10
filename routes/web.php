<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\ConnectionRequestController;
use App\Http\Controllers\DiscoveryController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SafetyController;
use Illuminate\Support\Facades\Route;

// Page d'accueil publique
Route::view('/', 'welcome')->name('home');

// Authentification (invités uniquement)
Route::middleware('guest')->group(function () {
    Route::get('/inscription', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/inscription', [RegisteredUserController::class, 'store']);

    Route::get('/connexion', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/connexion', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/deconnexion', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Zone authentifiée
Route::middleware('auth')->group(function () {

    // Onboarding (première connexion)
    Route::get('/bienvenue/interets', [OnboardingController::class, 'interests'])->name('onboarding.interests');
    Route::post('/bienvenue/interets', [OnboardingController::class, 'storeInterests']);
    Route::get('/bienvenue/confidentialite', [OnboardingController::class, 'privacy'])->name('onboarding.privacy');
    Route::post('/bienvenue/confidentialite', [OnboardingController::class, 'storePrivacy']);

    // Découverte
    Route::get('/decouverte', [DiscoveryController::class, 'index'])->name('discovery.index');

    // Profil
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profil/{user}', [ProfileController::class, 'show'])->name('profile.show');

    // Réglages de confidentialité (modifiables à tout moment)
    Route::get('/parametres/confidentialite', [OnboardingController::class, 'privacy'])->name('privacy.edit');
    Route::patch('/parametres/confidentialite', [OnboardingController::class, 'storePrivacy'])->name('privacy.update');

    // Demandes de connexion
    Route::get('/demandes', [ConnectionRequestController::class, 'received'])->name('requests.received');
    Route::post('/demandes', [ConnectionRequestController::class, 'store'])->name('requests.store');
    Route::patch('/demandes/{connectionRequest}/accepter', [ConnectionRequestController::class, 'accept'])->name('requests.accept');
    Route::patch('/demandes/{connectionRequest}/refuser', [ConnectionRequestController::class, 'decline'])->name('requests.decline');

    // Connexions établies + WhatsApp
    Route::get('/connexions', [ConnectionController::class, 'index'])->name('connections.index');
    Route::get('/connexions/{connection}/whatsapp', [ConnectionController::class, 'redirectToWhatsapp'])->name('connections.whatsapp');

    // Sécurité
    Route::post('/bloquer', [SafetyController::class, 'block'])->name('safety.block');
    Route::post('/signaler', [SafetyController::class, 'report'])->name('safety.report');
});