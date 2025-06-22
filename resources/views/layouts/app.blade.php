<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Penentuan Jurusan</title>

    {{-- Tailwind CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-indigo-600 text-white p-4 fixed top-0 left-0 h-screen transition disabled:opacity-50">
            <div class="mb-6 text-center">
                <h5 class="text-xl font-bold">Sistem Pakar</h5>
                <p class="text-sm text-purple-200">Penentuan Jurusan</p>
            </div>

            <nav class="space-y-3">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 hover:bg-indigo-500 p-2 rounded <?= request()->is('') ? 'bg-indigo-500' : '' ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('konsultasi.index') }}" class="flex items-center space-x-2 hover:bg-indigo-500 p-2 rounded <?= request()->is('konsultasi') ? 'bg-indigo-500' : '' ?>">
                    <i class="fas fa-comments"></i>
                    <span>Konsultasi</span>
                </a>
                <a href="{{ route('konsultasi.riwayat') }}" class="flex items-center space-x-2 hover:bg-indigo-500 p-2 rounded <?= request()->is('konsultasi/riwayat') ? 'bg-indigo-500' : '' ?>">
                    <i class="fas fa-history"></i>
                    <span>Riwayat</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 flex-1 p-6">
            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
