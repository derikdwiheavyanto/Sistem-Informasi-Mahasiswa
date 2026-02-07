<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login • MahasiswaApp</title>
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700">

    {{-- Card --}}
    <div class="w-full max-w-md bg-white/90 backdrop-blur rounded-2xl shadow-2xl p-8">

        {{-- Logo / Title --}}
        <div class="text-center mb-6">
            <div class="text-4xl mb-2">🎓</div>
            <h1 class="text-2xl font-bold text-gray-800">MahasiswaApp</h1>
            <p class="text-sm text-gray-500">Silakan login untuk melanjutkan</p>
        </div>

        {{-- Error --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="/login" class="space-y-4">
            @csrf

            {{-- Username --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Username
                </label>
                <input type="text" name="username" required autofocus placeholder="Masukkan username"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Password
                </label>
                <input type="password" name="password" required placeholder="Masukkan password"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>

            {{-- Button --}}
            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-2.5 rounded-lg font-semibold hover:opacity-90 active:scale-[0.98] transition">
                🔐 Login
            </button>
        </form>

        {{-- Footer --}}
        <div class="text-center text-xs text-gray-500 mt-6">
            © {{ date('Y') }} MahasiswaApp • Sistem Informasi Akademik
        </div>
    </div>

</body>

</html>
