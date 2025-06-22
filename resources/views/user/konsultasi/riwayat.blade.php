@extends('layouts.user')

@section('title', 'Riwayat Konsultasi')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-6 py-4 rounded-t-lg">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">Riwayat Konsultasi</h1>
                <div class="flex space-x-2">
                    <a href="{{ route('konsultasi.index') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <a href="{{ route('konsultasi.form') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-200">
                        <i class="fas fa-plus mr-2"></i>Konsultasi Baru
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6">
            @if($riwayatKonsultasi->count() > 0)
                <!-- Statistik -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-blue-50 p-4 rounded-lg border-l-4 border-blue-500">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-500 rounded-lg">
                                <i class="fas fa-chart-line text-white"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">Total Konsultasi</p>
                                <p class="text-2xl font-bold text-blue-600">{{ $riwayatKonsultasi->total() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-50 p-4 rounded-lg border-l-4 border-green-500">
                        <div class="flex items-center">
                            <div class="p-2 bg-green-500 rounded-lg">
                                <i class="fas fa-arrow-right text-white"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">Forward Chaining</p>
                                <p class="text-2xl font-bold text-green-600">
                                    {{ $riwayatKonsultasi->where('metode', 'forward')->count() }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-purple-50 p-4 rounded-lg border-l-4 border-purple-500">
                        <div class="flex items-center">
                            <div class="p-2 bg-purple-500 rounded-lg">
                                <i class="fas fa-arrow-left text-white"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">Backward Chaining</p>
                                <p class="text-2xl font-bold text-purple-600">
                                    {{ $riwayatKonsultasi->where('metode', 'backward')->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Riwayat -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Siswa
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Asal Sekolah
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Metode
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($riwayatKonsultasi as $index => $konsultasi)
                                <tr class="hover:bg-gray-50 transition duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ ($riwayatKonsultasi->currentPage() - 1) * $riwayatKonsultasi->perPage() + $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $konsultasi->nama_siswa }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $konsultasi->asal_sekolah }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($konsultasi->metode === 'forward')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-arrow-right mr-1"></i>
                                                Forward Chaining
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                <i class="fas fa-arrow-left mr-1"></i>
                                                Backward Chaining
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex flex-col">
                                            <span>{{ $konsultasi->created_at->format('d/m/Y') }}</span>
                                            <span class="text-xs text-gray-500">{{ $konsultasi->created_at->format('H:i') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('konsultasi.detail', $konsultasi->id) }}"
                                               class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition duration-200">
                                                <i class="fas fa-eye mr-1"></i>Detail
                                            </a>
                                            <button onclick="printResult({{ $konsultasi->id }})"
                                                    class="bg-gray-500 text-white px-3 py-1 rounded-lg hover:bg-gray-600 transition duration-200">
                                                <i class="fas fa-print mr-1"></i>Print
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $riwayatKonsultasi->links() }}
                </div>

            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="mx-auto h-24 w-24 text-gray-400">
                        <i class="fas fa-history text-6xl"></i>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada riwayat konsultasi</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Mulailah konsultasi pertama Anda untuk melihat riwayat di sini.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('konsultasi.form') }}"
                           class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i>
                            Mulai Konsultasi
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- JavaScript untuk Print -->
<script>
function printResult(konsultasiId) {
    // Buka detail konsultasi di tab baru untuk print
    const url = `{{ route('konsultasi.detail', ':id') }}`.replace(':id', konsultasiId);
    const printWindow = window.open(url + '?print=1', '_blank');

    printWindow.onload = function() {
        printWindow.print();
    };
}
</script>

@endsection
