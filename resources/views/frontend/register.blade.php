<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription — FriendLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
</head>
<body>
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                @if (session('status'))
                    <div class="fl-form-card p-5 text-center">
                        <i class="bi bi-check-circle-fill text-success display-4 mb-3"></i>
                        <h2 class="h4 fw-bold mb-2">{{ session('status') }}</h2>
                        <a href="{{ route('discovery.index') }}" class="btn btn-fl-primary px-4">Découvrir les profils</a>
                    </div>
                @else
                    <form method="POST" action="{{ route('register') }}" class="fl-form-card p-4 p-md-5">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-medium">Nom complet *</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-medium">Pseudo *</label>
                                <input type="text" name="username" value="{{ old('username') }}"
                                       class="form-control @error('username') is-invalid @enderror" required>
                                @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-medium">Adresse e-mail *</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                       class="form-control @error('email') is-invalid @enderror" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-medium">Numéro WhatsApp *</label>
                                <input type="tel" name="phone" value="{{ old('phone') }}"
                                       class="form-control @error('phone') is-invalid @enderror" required>
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-medium">Mot de passe *</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-medium">Confirmer le mot de passe *</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-fl-primary btn-lg w-100 mt-4">
                            Créer mon compte
                        </button>
                    </form>
                @endif

            </div>
        </div>
    </main>
</body>
</html>