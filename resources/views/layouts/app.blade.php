<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MahasiswaApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 min-h-screen flex">

    {{-- Sidebar --}}
    <aside
        class="hidden md:flex md:flex-col w-64 bg-gradient-to-b from-slate-900 to-slate-800 text-white fixed inset-y-0">
        <div class="px-6 py-5 text-xl font-bold tracking-wide border-b border-slate-700">
            🎓 MahasiswaApp
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 text-sm">
            <a href="/dashboard" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-slate-700 transition">
                📊 <span>Dashboard</span>
            </a>

            <a href="/" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-slate-700 transition">
                📚 <span>Data Mahasiswa</span>
            </a>
        </nav>

        <div class="px-4 py-4 border-t border-slate-700 text-xs text-slate-400">
            © {{ date('Y') }} MahasiswaApp
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 md:ml-64 min-h-screen flex flex-col min-w-0">

        {{-- Topbar --}}
        <header class="bg-white shadow-sm px-4 py-3 md:px-6 sticky top-0 z-20 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <button id="mobileMenuBtn" class="md:hidden text-xl text-gray-600">
                    ☰
                </button>
                <h1 class="text-lg font-semibold text-gray-700">
                    @yield('title', 'Dashboard')
                </h1>
            </div>

            <form id="logoutForm" method="POST" action="/logout">
                @csrf
                <button type="button" id="btnLogout"
                    class="text-sm px-4 py-1.5 rounded-lg border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition">
                    Logout
                </button>
            </form>

        </header>

        {{-- Mobile Sidebar --}}
        <div id="mobileSidebar" class="fixed inset-0 bg-black/50 z-40 hidden">
            <aside class="bg-slate-900 w-64 h-full p-5 text-white">
                <div class="flex justify-between items-center mb-6">
                    <span class="font-bold text-xl">🎓 MahasiswaApp</span>
                    <button id="closeMobileSidebar" class="text-xl">✖</button>
                </div>

                <nav class="space-y-2">
                    <a href="/dashboard" class="block px-4 py-2 rounded-lg hover:bg-slate-700 transition">
                        📊 Dashboard
                    </a>
                    <a href="/" class="block px-4 py-2 rounded-lg hover:bg-slate-700 transition">
                        📚 Data Mahasiswa
                    </a>
                </nav>
            </aside>
        </div>

        {{-- Page Content --}}
        <main class="flex-1 p-4 sm:p-6">
            @yield('content')
        </main>
    </div>

    {{-- Vendor --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Chart / Page Scripts --}}
    @stack('scripts')

    {{-- Sidebar Script --}}
    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const closeMobileSidebar = document.getElementById('closeMobileSidebar');

        mobileMenuBtn?.addEventListener('click', () => {
            mobileSidebar.classList.remove('hidden');
        });

        closeMobileSidebar?.addEventListener('click', () => {
            mobileSidebar.classList.add('hidden');
        });

        mobileSidebar?.addEventListener('click', (e) => {
            if (e.target === mobileSidebar) mobileSidebar.classList.add('hidden');
        });
    </script>

    {{-- Toast --}}
    @if (session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2500
            })
        </script>
    @endif

    <script>
        const btnLogout = document.getElementById('btnLogout');
        const logoutForm = document.getElementById('logoutForm');

        btnLogout?.addEventListener('click', () => {
            Swal.fire({
                title: 'Logout?',
                text: 'Kamu akan keluar dari aplikasi',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    logoutForm.submit();
                }
            });
        });
    </script>

</body>

</html>
