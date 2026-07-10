<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FriendLink — Connexions authentiques, en toute confiance</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900 antialiased">

    {{-- Navigation --}}
    <nav class="max-w-6xl mx-auto px-6 py-5 flex items-center justify-between">
        <span class="font-semibold text-lg tracking-tight">FriendLink</span>
        <div class="flex items-center gap-3">
            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">
                Se connecter
            </a>
            <a href="{{ route('register') }}" class="bg-gray-900 text-white text-sm font-medium rounded-lg px-4 py-2 hover:bg-gray-800">
                Créer un compte
            </a>
        </div>
    </nav>

    {{-- Héro --}}
    <header class="max-w-4xl mx-auto px-6 pt-16 pb-20 text-center">
        <span class="inline-block text-xs font-medium text-emerald-700 bg-emerald-50 rounded-full px-3 py-1 mb-6">
            🔒 Confidentialité vérifiée avant chaque échange
        </span>
        <h1 class="text-4xl sm:text-5xl font-semibold tracking-tight mb-5 leading-tight">
            Rencontrez des personnes qui vous ressemblent,<br class="hidden sm:block"> en toute confiance.
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">
            FriendLink vous met en relation avec des personnes qui partagent vos centres d'intérêt.
            L'échange se poursuit sur WhatsApp, uniquement quand vous êtes prêt.
        </p>
        <div class="flex items-center justify-center gap-3">
            <a href="{{ route('register') }}" class="bg-gray-900 text-white font-medium rounded-lg px-6 py-3 hover:bg-gray-800">
                Créer mon compte gratuitement
            </a>
            <a href="#comment-ca-marche" class="text-gray-700 font-medium rounded-lg px-6 py-3 border hover:bg-gray-50">
                Comment ça marche
            </a>
        </div>
    </header>

    {{-- Bandeau de confiance --}}
    <div class="border-y bg-gray-50">
        <div class="max-w-5xl mx-auto px-6 py-6 grid grid-cols-2 sm:grid-cols-4 gap-6 text-center">
            <div>
                <p class="text-2xl font-semibold">100%</p>
                <p class="text-xs text-gray-500 mt-1">Numéro jamais public</p>
            </div>
            <div>
                <p class="text-2xl font-semibold">2 clics</p>
                <p class="text-xs text-gray-500 mt-1">Pour envoyer une demande</p>
            </div>
            <div>
                <p class="text-2xl font-semibold">Mutuel</p>
                <p class="text-xs text-gray-500 mt-1">Contact révélé si les deux acceptent</p>
            </div>
            <div>
                <p class="text-2xl font-semibold">WhatsApp</p>
                <p class="text-xs text-gray-500 mt-1">Là où vous êtes déjà à l'aise</p>
            </div>
        </div>
    </div>

    {{-- Comment ça marche --}}
    <section id="comment-ca-marche" class="max-w-5xl mx-auto px-6 py-20">
        <h2 class="text-2xl font-semibold text-center mb-2">Comment ça marche</h2>
        <p class="text-gray-500 text-center mb-12">Trois étapes, à votre rythme.</p>

        <div class="grid sm:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-11 h-11 rounded-full bg-gray-900 text-white flex items-center justify-center mx-auto mb-4 font-medium">
                    1
                </div>
                <h3 class="font-medium mb-2">Créez votre profil</h3>
                <p class="text-sm text-gray-500">
                    Renseignez vos centres d'intérêt et définissez vos propres règles de confidentialité.
                </p>
            </div>
            <div class="text-center">
                <div class="w-11 h-11 rounded-full bg-gray-900 text-white flex items-center justify-center mx-auto mb-4 font-medium">
                    2
                </div>
                <h3 class="font-medium mb-2">Découvrez des profils</h3>
                <p class="text-sm text-gray-500">
                    Parcourez des personnes qui partagent vos passions, filtrées selon vos critères.
                </p>
            </div>
            <div class="text-center">
                <div class="w-11 h-11 rounded-full bg-gray-900 text-white flex items-center justify-center mx-auto mb-4 font-medium">
                    3
                </div>
                <h3 class="font-medium mb-2">Échangez sur WhatsApp</h3>
                <p class="text-sm text-gray-500">
                    Une fois la connexion mutuelle acceptée, poursuivez la conversation là où vous êtes déjà.
                </p>
            </div>
        </div>
    </section>

    {{-- Bloc confidentialité (le différenciateur) --}}
    <section class="bg-gray-900 text-white">
        <div class="max-w-5xl mx-auto px-6 py-20 grid sm:grid-cols-2 gap-10 items-center">
            <div>
                <span class="inline-block text-xs font-medium text-emerald-300 bg-emerald-900/40 rounded-full px-3 py-1 mb-4">
                    Notre engagement
                </span>
                <h2 class="text-2xl font-semibold mb-4">
                    Votre numéro n'est jamais affiché en clair.
                </h2>
                <p class="text-gray-300 text-sm leading-relaxed mb-6">
                    Contrairement aux réseaux sociaux classiques, FriendLink ne stocke ni n'affiche jamais votre
                    contact WhatsApp publiquement. Il n'est révélé que lorsque les conditions de confidentialité
                    des deux personnes sont réunies — jamais avant, jamais sans votre accord.
                </p>
                <a href="{{ route('register') }}" class="inline-block bg-white text-gray-900 font-medium rounded-lg px-5 py-2.5 text-sm">
                    Définir mes règles de confidentialité
                </a>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-3">
                <div class="flex items-center gap-3 bg-white/5 rounded-lg px-4 py-3">
                    <span>🔒</span>
                    <span class="text-sm text-gray-200">Profil visible aux intérêts communs uniquement</span>
                </div>
                <div class="flex items-center gap-3 bg-white/5 rounded-lg px-4 py-3">
                    <span>🟡</span>
                    <span class="text-sm text-gray-200">Contact réservé aux profils vérifiés</span>
                </div>
                <div class="flex items-center gap-3 bg-white/5 rounded-lg px-4 py-3">
                    <span>✅</span>
                    <span class="text-sm text-gray-200">Confirmation manuelle avant le partage WhatsApp</span>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA final --}}
    <section class="max-w-3xl mx-auto px-6 py-20 text-center">
        <h2 class="text-2xl font-semibold mb-3">Prêt à faire de nouvelles connexions ?</h2>
        <p class="text-gray-500 mb-8">Gratuit, rapide, et vous gardez le contrôle à chaque étape.</p>
        <a href="{{ route('register') }}" class="inline-block bg-gray-900 text-white font-medium rounded-lg px-8 py-3">
            Créer mon compte
        </a>
    </section>

    {{-- Footer --}}
    <footer class="border-t">
        <div class="max-w-6xl mx-auto px-6 py-8 flex items-center justify-between text-sm text-gray-500">
            <span>© {{ date('Y') }} FriendLink</span>
            <div class="flex gap-4">
                <a href="{{ route('login') }}" class="hover:text-gray-900">Se connecter</a>
                <a href="{{ route('register') }}" class="hover:text-gray-900">S'inscrire</a>
            </div>
        </div>
    </footer>

</body>
</html>