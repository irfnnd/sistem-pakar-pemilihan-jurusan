<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Pakar Penentuan Jurusan')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body class=" text-gray-800 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-5 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <i class="fas fa-graduation-cap text-blue-600 text-xl"></i>
                <span class="text-lg font-bold text-gray-800">Sistem Pakar Jurusan</span>
            </div>

            <!-- Hamburger button -->
            <button id="menu-toggle" class="md:hidden text-gray-800 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Menu (desktop) -->
            <div class="hidden md:flex items-center gap-6">
                <a href="#" class="text-sm hover:text-blue-600 transition">Beranda</a>
                <a href="#" class="text-sm hover:text-blue-600 transition">Konsultasi</a>
                <a href="#" class="text-sm hover:text-blue-600 transition">Riwayat</a>

                <form method="POST" action="#">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:underline">Keluar</button>
                </form>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden px-4 pb-4">
            <a href="#" class="block py-2 text-sm hover:text-blue-600 transition">Beranda</a>
            <a href="#" class="block py-2 text-sm hover:text-blue-600 transition">Konsultasi</a>
            <a href="#" class="block py-2 text-sm hover:text-blue-600 transition">Riwayat</a>

            <form method="POST" action="#" class="pt-2">
                @csrf
                <button type="submit" class="text-sm text-red-600 hover:underline">Keluar</button>
            </form>
        </div>
    </nav>

    <!-- Content -->
    <main class="flex items-center justify-center p-4" style="min-height: 90vh">
        @yield('content')
    </main>

    <!-- Scripts -->
    @yield('scripts')

    <!-- Script toggle mobile menu -->
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

</body>

</html>
