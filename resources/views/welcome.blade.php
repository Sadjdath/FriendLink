<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FriendLink — Connexions authentiques, en toute confiance</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">
    <div class="max-w-lg mx-auto text-center px-6 py-24">
        <h1 class="text-3xl font-semibold mb-3">FriendLink</h1>
        <p class="text-gray-600 mb-8">Découvrez des personnes qui partagent vos centres d'intérêt, et échangez sur WhatsApp uniquement quand vous êtes prêt.</p>
        <div class="flex gap-3 justify-center">
            <a href="{{ route('register') }}" class="bg-gray-900 text-white rounded-lg px-6 py-2.5 font-medium">Créer un compte</a>
            <a href="{{ route('login') }}" class="border rounded-lg px-6 py-2.5 font-medium">Se connecter</a>
        </div>
    </div>
</body>
</html>
