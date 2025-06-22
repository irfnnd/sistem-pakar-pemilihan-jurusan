@extends('layouts.user')

@section('title', 'Detail Konsultasi - ' . $konsultasi->nama_siswa)

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-6 py-4 rounded-t-lg">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold">Detail Konsultasi</h1>
                    <div class="flex space-x-2">
                        <a href="{{ route('konsultasi.riwayat') }}"
                            class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                        <button onclick="window.print()"
                            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-200">
                            <i class="fas fa-print mr-2"></i>Print
                        </button>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Informasi Umum -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-user mr-2 text-blue-500"></i>Informasi Siswa
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nama:</span>
                                <span class="font-medium">{{ $konsultasi->nama_siswa }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Asal Sekolah:</span>
                                <span class="font-medium">{{ $konsultasi->asal_sekolah }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal Konsultasi:</span>
                                <span class="font-medium">{{ $konsultasi->created_at->format('d F Y, H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            <i class="fas fa-cog mr-2 text-purple-500"></i>Metode Konsultasi
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Metode:</span>
                                @if ($konsultasi->metode === 'forward')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-arrow-right mr-1"></i>
                                        Forward Chaining
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                        <i class="fas fa-arrow-left mr-1"></i>
                                        Backward Chaining
                                    </span>
                                @endif
                            </div>
                            <div class="mt-4">
                                <p class="text-sm text-gray-600">
                                    @if ($konsultasi->metode === 'forward')
                                        Forward Chaining menganalisis jawaban Anda untuk menentukan jurusan yang paling
                                        sesuai berdasarkan kecerdasan yang terdeteksi.
                                    @else
                                        Backward Chaining memverifikasi apakah jurusan yang Anda inginkan sesuai dengan
                                        profil kecerdasan Anda.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jawaban Siswa -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">
                        <i class="fas fa-question-circle mr-2 text-orange-500"></i>Jawaban Konsultasi
                    </h3>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        @if (is_array($konsultasi->jawaban))
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($konsultasi->jawaban as $key => $value)
                                    <div class="flex items-center justify-between p-3 bg-white rounded border">
                                        <span class="text-gray-700">Pertanyaan {{ $key }}:</span>
                                        <span class="font-medium">
                                            @if ($value == 1)
                                                <span class="text-green-600">Ya</span>
                                            @else
                                                <span class="text-red-600">Tidak</span>
                                            @endif
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-600">Data jawaban tidak tersedia dalam format yang dapat ditampilkan.</p>
                        @endif
                    </div>
                </div>

                <!-- Hasil Konsultasi -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">
                        <i class="fas fa-chart-bar mr-2 text-green-500"></i>Hasil Konsultasi
                    </h3>

                    @if (is_array($konsultasi->hasil))
                        <!-- Hasil Forward Chaining -->
                        @if ($konsultasi->metode === 'forward' && isset($konsultasi->hasil['rekomendasi_jurusan']))
                            <div class="space-y-6">
                                <!-- Kecerdasan Terdeteksi -->
                                @if (isset($konsultasi->hasil['kecerdasan_terdeteksi']) && !empty($konsultasi->hasil['kecerdasan_terdeteksi']))
                                    <div class="bg-blue-50 p-6 rounded-lg border-l-4 border-blue-500">
                                        <h4 class="text-lg font-semibold text-blue-800 mb-3">Kecerdasan Terdeteksi</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                            @foreach ($konsultasi->hasil['kecerdasan_terdeteksi'] as $kecerdasan)
                                                <div class="bg-white p-3 rounded border">
                                                    <span
                                                        class="font-medium text-blue-700">{{ $kecerdasan['nama'] ?? 'N/A' }}</span>
                                                    <p class="text-sm text-gray-600 mt-1">
                                                        {{ $kecerdasan['deskripsi'] ?? '' }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Rekomendasi Jurusan -->
                                <div class="bg-green-50 p-6 rounded-lg border-l-4 border-green-500">
                                    <h4 class="text-lg font-semibold text-green-800 mb-3">Rekomendasi Jurusan</h4>
                                    <div class="space-y-4">
                                        @foreach ($konsultasi->hasil['rekomendasi_jurusan'] as $jurusan)
                                            <div class="bg-white p-4 rounded-lg shadow-sm border border-green-200">
                                                <div class="flex justify-between items-start mb-2">
                                                    <h5 class="font-semibold text-green-700">{{ $jurusan['nama'] ?? 'N/A' }}
                                                    </h5>
                                                    <span
                                                        class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm font-medium">
                                                        {{ number_format($jurusan['persentase'] ?? 0, 1) }}%
                                                    </span>
                                                </div>
                                                <p class="text-gray-600 text-sm">{{ $jurusan['deskripsi'] ?? '' }}</p>
                                                @if (isset($jurusan['prospek_karir']))
                                                    <div class="mt-2">
                                                        <p class="text-sm text-gray-500">
                                                            <strong>Prospek Karir:</strong> {{ $jurusan['prospek_karir'] }}
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Hasil Backward Chaining -->
                        @elseif($konsultasi->metode === 'backward' && isset($konsultasi->hasil['kesimpulan']))
                            <div class="space-y-6">
                                <!-- Status Kesesuaian -->
                                <div
                                    class="p-6 rounded-lg border-l-4 {{ $konsultasi->hasil['sesuai'] ? 'bg-green-50 border-green-500' : 'bg-red-50 border-red-500' }}">
                                    <h4
                                        class="text-lg font-semibold mb-3 {{ $konsultasi->hasil['sesuai'] ? 'text-green-800' : 'text-red-800' }}">
                                        Status Kesesuaian
                                    </h4>
                                    <p class="mb-3 {{ $konsultasi->hasil['sesuai'] ? 'text-green-700' : 'text-red-700' }}">
                                        {{ $konsultasi->hasil['kesimpulan'] }}
                                    </p>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $konsultasi->hasil['sesuai'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        <i
                                            class="fas {{ $konsultasi->hasil['sesuai'] ? 'fa-check' : 'fa-times' }} mr-1"></i>
                                        {{ $konsultasi->hasil['sesuai'] ? 'Sesuai' : 'Tidak Sesuai' }}
                                    </span>
                                </div>

                                <!-- Detail Analisis -->
                                @if (isset($konsultasi->hasil['detail_analisis']))
                                    <div class="bg-gray-50 p-6 rounded-lg">
                                        <h4 class="text-lg font-semibold text-gray-800 mb-3">Detail Analisis</h4>
                                        <div class="prose text-gray-600">
                                            {!! nl2br(e($konsultasi->hasil['detail_analisis'])) !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- Saran dan Rekomendasi -->
                        @if (isset($konsultasi->hasil['saran']))
                            <div class="mt-6 bg-yellow-50 p-6 rounded-lg border-l-4 border-yellow-500">
                                <h4 class="text-lg font-semibold text-yellow-800 mb-3">
                                    <i class="fas fa-lightbulb mr-2"></i>Saran dan Rekomendasi
                                </h4>
                                <div class="text-yellow-700">
                                    {!! nl2br(e($konsultasi->hasil['saran'])) !!}
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <p class="text-gray-600">Data hasil tidak tersedia dalam format yang dapat ditampilkan.</p>
                            <div class="mt-4 bg-white p-4 rounded border">
                                <pre class="text-sm text-gray-700 whitespace-pre-wrap">{{ json_encode($konsultasi->hasil, JSON_PRETTY_PRINT) }}</pre>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="border-t pt-6 flex justify-center space-x-4">
                    <a href="{{ route('konsultasi.riwayat') }}"
                        class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
                        <i class="fas fa-list mr-2"></i>Lihat Riwayat Lain
                    </a>
                    <a href="{{ route('konsultasi.form') }}"
                        class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                        <i class="fas fa-plus mr-2"></i>Konsultasi Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Styles -->
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                font-size: 12pt;
                line-height: 1.4;
            }

            .container {
                max-width: none !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .bg-gradient-to-r {
                background: #1e40af !important;
                color: white !important;
            }

            .shadow-md {
                box-shadow: none !important;
            }
        }
    </style>

@endsection
