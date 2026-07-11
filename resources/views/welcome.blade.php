<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FriendLink — Connexions authentiques, en toute confiance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Manrope', 'sans-serif'] },
                    colors: {
                        brand: {
                            50: '#f0fdf9', 100: '#ccfbef', 200: '#99f6df',
                            300: '#5eead4', 400: '#2dd4bf', 500: '#14b8a6',
                            600: '#0d9488', 700: '#0f766e', 800: '#115e59', 900: '#134e4a',
                        },
                    },
                }
            }
        }
    </script>
    <style>body { font-family: 'Manrope', sans-serif; }</style>
</head>
<body class="bg-white text-slate-900 antialiased">

    <nav class="max-w-6xl mx-auto px-6 py-5 flex items-center justify-between">
        <a href="/" class="flex items-center gap-2">
            <span class="w-8 h-8 rounded-lg bg-brand-600 flex items-center justify-center text-white font-bold text-sm">F</span>
            <span class="font-bold text-lg tracking-tight">FriendLink</span>
        </a>
        <div class="flex items-center gap-3">
            <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">
                Se connecter
            </a>
            <a href="{{ route('register') }}" class="bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl px-4 py-2.5 transition shadow-sm shadow-brand-600/20">
                Créer un compte
            </a>
        </div>
    </nav>

    <header class="max-w-4xl mx-auto px-6 pt-16 pb-20 text-center">
        <span class="inline-block text-xs font-semibold text-brand-700 bg-brand-50 border border-brand-200 rounded-full px-3 py-1.5 mb-6">
            🔒 Confidentialité vérifiée avant chaque échange
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight mb-5 leading-tight">
            Rencontrez des personnes qui vous ressemblent,<br class="hidden sm:block"> en toute confiance.
        </h1>
        <p class="text-lg text-slate-600 max-w-2xl mx-auto mb-8">
            FriendLink vous met en relation avec des personnes qui partagent vos centres d'intérêt.
            L'échange se poursuit sur WhatsApp, uniquement quand vous êtes prêt.
        </p>
        <div class="flex items-center justify-center gap-3">
            <a href="{{ route('register') }}" class="bg-brand-600 hover:bg-brand-700 text-white font-semibold rounded-xl px-6 py-3 transition shadow-sm shadow-brand-600/20">
                Créer mon compte gratuitement
            </a>
            <a href="#comment-ca-marche" class="text-slate-700 font-semibold rounded-xl px-6 py-3 border border-slate-200 hover:bg-slate-50 transition">
                Comment ça marche
            </a>
        </div>
    </header>

    <div class="border-y border-slate-200 bg-slate-50">
        <div class="max-w-5xl mx-auto px-6 py-6 grid grid-cols-2 sm:grid-cols-4 gap-6 text-center">
            <div>
                <p class="text-2xl font-extrabold text-brand-700">100%</p>
                <p class="text-xs text-slate-500 mt-1">Numéro jamais public</p>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-brand-700">2 clics</p>
                <p class="text-xs text-slate-500 mt-1">Pour envoyer une demande</p>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-brand-700">Mutuel</p>
                <p class="text-xs text-slate-500 mt-1">Contact révélé si les deux acceptent</p>
            </div>
            <div>
                <p class="text-2xl font-extrabold text-brand-700">WhatsApp</p>
                <p class="text-xs text-slate-500 mt-1">Là où vous êtes déjà à l'aise</p>
            </div>
        </div>
    </div>

    <section id="comment-ca-marche" class="max-w-5xl mx-auto px-6 py-20">
        <h2 class="text-2xl font-bold text-center mb-2">Comment ça marche</h2>
        <p class="text-slate-500 text-center mb-12">Trois étapes, à votre rythme.</p>

        <div class="grid sm:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-11 h-11 rounded-xl bg-brand-600 text-white flex items-center justify-center mx-auto mb-4 font-bold">1</div>
                <h3 class="font-semibold mb-2">Créez votre profil</h3>
                <p class="text-sm text-slate-500">Renseignez vos centres d'intérêt et définissez vos propres règles de confidentialité.</p>
            </div>
            <div class="text-center">
                <div class="w-11 h-11 rounded-xl bg-brand-600 text-white flex items-center justify-center mx-auto mb-4 font-bold">2</div>
                <h3 class="font-semibold mb-2">Découvrez des profils</h3>
                <p class="text-sm text-slate-500">Parcourez des personnes qui partagent vos passions, filtrées selon vos critères.</p>
            </div>
            <div class="text-center">
                <div class="w-11 h-11 rounded-xl bg-brand-600 text-white flex items-center justify-center mx-auto mb-4 font-bold">3</div>
                <h3 class="font-semibold mb-2">Échangez sur WhatsApp</h3>
                <p class="text-sm text-slate-500">Une fois la connexion mutuelle acceptée, poursuivez la conversation là où vous êtes déjà.</p>
            </div>
        </div>
    </section>

    <section class="bg-slate-900 text-white">
        <div class="max-w-5xl mx-auto px-6 py-20 grid sm:grid-cols-2 gap-10 items-center">
            <div>
                <span class="inline-block text-xs font-semibold text-brand-300 bg-brand-900/40 rounded-full px-3 py-1.5 mb-4">
                    Notre engagement
                </span>
                <h2 class="text-2xl font-bold mb-4">Votre numéro n'est jamais affiché en clair.</h2>
                <p class="text-slate-300 text-sm leading-relaxed mb-6">
                    Contrairement aux réseaux sociaux classiques, FriendLink ne stocke ni n'affiche jamais votre
                    contact WhatsApp publiquement. Il n'est révélé que lorsque les conditions de confidentialité
                    des deux personnes sont réunies — jamais avant, jamais sans votre accord.
                </p>
                <a href="{{ route('register') }}" class="inline-block bg-white hover:bg-slate-100 text-slate-900 font-semibold rounded-xl px-5 py-2.5 text-sm transition">
                    Définir mes règles de confidentialité
                </a>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-3">
                <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3">
                    <span>🔒</span>
                    <span class="text-sm text-slate-200">Profil visible aux intérêts communs uniquement</span>
                </div>
                <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3">
                    <span>🟡</span>
                    <span class="text-sm text-slate-200">Contact réservé aux profils vérifiés</span>
                </div>
                <div class="flex items-center gap-3 bg-white/5 rounded-xl px-4 py-3">
                    <span>✅</span>
                    <span class="text-sm text-slate-200">Confirmation manuelle avant le partage WhatsApp</span>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-3xl mx-auto px-6 py-20 text-center">
        <h2 class="text-2xl font-bold mb-3">Prêt à faire de nouvelles connexions ?</h2>
        <p class="text-slate-500 mb-8">Gratuit, rapide, et vous gardez le contrôle à chaque étape.</p>
        <a href="{{ route('register') }}" class="inline-block bg-brand-600 hover:bg-brand-700 text-white font-semibold rounded-xl px-8 py-3 transition shadow-sm shadow-brand-600/20">
            Créer mon compte
        </a>
    </section>

    <footer class="border-t border-slate-200">
        <div class="max-w-6xl mx-auto px-6 py-8 flex items-center justify-between text-sm text-slate-500">
            <span>© {{ date('Y') }} FriendLink</span>
            <div class="flex gap-4">
                <a href="{{ route('login') }}" class="hover:text-slate-900">Se connecter</a>
                <a href="{{ route('register') }}" class="hover:text-slate-900">S'inscrire</a>
            </div>
        </div>
    </footer>

</body>
</html>