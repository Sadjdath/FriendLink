<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FriendLink — @yield('title', 'Connexions authentiques')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">
    <nav class="bg-white border-b px-6 py-3 flex items-center justify-between">
        <a href="{{ route('discovery.index') }}" class="font-semibold text-lg">FriendLink</a>
        @auth
            <div class="flex items-center gap-4 text-sm">
                <a href="{{ route('discovery.index') }}">Découverte</a>
                <a href="{{ route('connections.index') }}">Connexions</a>
                <a href="{{ route('privacy.edit') }}">Confidentialité</a>
                <a href="{{ route('profile.edit') }}">Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Déconnexion</button>
                </form>
            </div>
        @endauth
    </nav>

    <main class="max-w-3xl mx-auto px-4 py-8">
        @if (session('status'))
            <div class="mb-4 rounded-lg bg-green-100 text-green-800 px-4 py-3 text-sm">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-100 text-red-800 px-4 py-3 text-sm">
                <ul class="list-disc list-inside">
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