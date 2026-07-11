<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FriendLink — @yield('title', 'Connexions authentiques')</title>
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
<body class="bg-slate-50 text-slate-900" x-data="{ mobileMenuOpen: false }">
    <nav class="bg-white/80 backdrop-blur border-b border-slate-200 sticky top-0 z-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
            <a href="{{ route('discovery.index') }}" class="flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-brand-600 flex items-center justify-center text-white font-bold text-sm">F</span>
                <span class="font-bold text-lg tracking-tight">FriendLink</span>
            </a>

            @auth
                {{-- Menu desktop --}}
                <div class="hidden md:flex items-center gap-1 text-sm font-medium">
                    <a href="{{ route('discovery.index') }}" class="px-3 py-2 rounded-lg hover:bg-slate-100 text-slate-600 hover:text-slate-900 transition">Découverte</a>
                    <a href="{{ route('requests.received') }}" class="px-3 py-2 rounded-lg hover:bg-slate-100 text-slate-600 hover:text-slate-900 transition">Demandes</a>
                    <a href="{{ route('connections.index') }}" class="px-3 py-2 rounded-lg hover:bg-slate-100 text-slate-600 hover:text-slate-900 transition">Connexions</a>
                    <a href="{{ route('privacy.edit') }}" class="px-3 py-2 rounded-lg hover:bg-slate-100 text-slate-600 hover:text-slate-900 transition">Confidentialité</a>
                    <a href="{{ route('profile.edit') }}" class="px-3 py-2 rounded-lg hover:bg-slate-100 text-slate-600 hover:text-slate-900 transition">Profil</a>
                    <form method="POST" action="{{ route('logout') }}" class="ml-2">
                        @csrf
                        <button type="submit" class="px-3 py-2 rounded-lg border border-slate-200 hover:bg-slate-100 text-slate-600 transition">
                            Déconnexion
                        </button>
                    </form>
                </div>

                {{-- Bouton hamburger mobile --}}
                <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                        class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg hover:bg-slate-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            @endauth
        </div>

        {{-- Menu mobile déroulant --}}
        @auth
            <div id="mobile-menu" class="hidden md:hidden border-t border-slate-200 bg-white">
                <div class="max-w-4xl mx-auto px-4 py-3 flex flex-col gap-1 text-sm font-medium">
                    <a href="{{ route('discovery.index') }}" class="px-3 py-2.5 rounded-lg hover:bg-slate-100 text-slate-600">Découverte</a>
                    <a href="{{ route('requests.received') }}" class="px-3 py-2.5 rounded-lg hover:bg-slate-100 text-slate-600">Demandes</a>
                    <a href="{{ route('connections.index') }}" class="px-3 py-2.5 rounded-lg hover:bg-slate-100 text-slate-600">Connexions</a>
                    <a href="{{ route('privacy.edit') }}" class="px-3 py-2.5 rounded-lg hover:bg-slate-100 text-slate-600">Confidentialité</a>
                    <a href="{{ route('profile.edit') }}" class="px-3 py-2.5 rounded-lg hover:bg-slate-100 text-slate-600">Profil</a>
                    <form method="POST" action="{{ route('logout') }}" class="pt-2 border-t border-slate-100 mt-1">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2.5 rounded-lg hover:bg-slate-100 text-slate-600">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        @endauth
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 py-6 sm:py-10">
        @if (session('status'))
            <div class="mb-6 flex items-start gap-3 rounded-xl bg-brand-50 border border-brand-200 text-brand-800 px-4 py-3 text-sm">
                <span class="mt-0.5">✓</span>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-red-50 border border-red-200 text-red-800 px-4 py-3 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>