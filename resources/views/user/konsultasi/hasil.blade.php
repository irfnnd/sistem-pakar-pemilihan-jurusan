@extends('layouts.user')

@section('title', 'Hasil Konsultasi')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg shadow-lg p-6 mb-8 text-white">
                <h1 class="text-3xl font-bold mb-2">Hasil Konsultasi Pemilihan Jurusan</h1>
                <p class="text-blue-100">Berikut adalah rekomendasi jurusan berdasarkan jawaban Anda</p>
            </div>

            <!-- Info Siswa -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">
                    <i class="fas fa-user text-blue-500 mr-2"></i>Informasi Siswa
                </h2>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Nama Siswa</label>
                        <p class="text-lg font-semibold text-gray-800">{{ $konsultasi->nama_siswa }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Asal Sekolah</label>
                        <p class="text-lg font-semibold text-gray-800">{{ $konsultasi->asal_sekolah }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Metode Analisis</label>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ $konsultasi->metode === 'forward' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            <i
                                class="fas {{ $konsultasi->metode === 'forward' ? 'fa-arrow-right' : 'fa-arrow-left' }} mr-1"></i>
                            {{ $konsultasi->metode === 'forward' ? 'Forward Chaining' : 'Backward Chaining' }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Tanggal Konsultasi</label>
                        <p class="text-lg font-semibold text-gray-800">{{ $konsultasi->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Hasil Rekomendasi -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">
                    <i class="fas fa-graduation-cap text-purple-500 mr-2"></i>Rekomendasi Jurusan
                </h2>

                @if (isset($hasil['rekomendasi']) && count($hasil['rekomendasi']) > 0)
                    <div class="space-y-4">
                        @php $index = 1; @endphp
                        @foreach ($hasil['rekomendasi'] as $kode => $item)
                            @foreach ($item['jurusan'] as $i => $jurusan)
                                <div
                                    class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center mb-2">
                                                <span
                                                    class="bg-gradient-to-r from-purple-500 to-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold mr-3">
                                                    {{ $loop->parent->iteration }}.{{ $loop->iteration }}
                                                </span>
                                                <h3 class="text-lg font-semibold text-gray-800">
                                                    {{ $jurusan['nama_jurusan'] }}
                                                </h3>
                                            </div>

                                            @if (!empty($jurusan['deskripsi']))
                                                <p class="text-gray-600 mb-2 ml-11">{{ $jurusan['deskripsi'] }}</p>
                                            @endif

                                            <div class="ml-11">
                                                <div class="flex items-center mb-2">
                                                    <span class="text-sm font-medium text-gray-600 mr-2">Tingkat
                                                        Kesesuaian:</span>
                                                    <div class="flex-1 bg-gray-200 rounded-full h-2 mr-2">
                                                        <div class="bg-gradient-to-r from-green-400 to-blue-500 h-2 rounded-full transition-all duration-500"
                                                            style="width: {{ round($item['kecerdasan']['persentase']) }}%">
                                                        </div>
                                                    </div>
                                                    <span
                                                        class="text-sm font-semibold text-gray-700">{{ round($item['kecerdasan']['persentase']) }}%</span>
                                                </div>
                                            </div>

                                            <div class="ml-11 mt-3">
                                                <p class="text-sm font-medium text-gray-600 mb-1">Ciri Cocok:</p>
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach ($item['kecerdasan']['ciri_cocok'] as $ciri)
                                                        <span
                                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            <i class="fas fa-check mr-1"></i>{{ $ciri }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach

                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-exclamation-circle text-yellow-500 text-4xl mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Tidak Ada Rekomendasi</h3>
                        <p class="text-gray-600">Berdasarkan jawaban Anda, sistem tidak dapat memberikan rekomendasi jurusan
                            yang sesuai.</p>
                    </div>
                @endif
            </div>

            <!-- Analisis Jawaban -->
            @if (isset($hasil['analisis']) || isset($hasil['jawaban_detail']))
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">
                        <i class="fas fa-chart-bar text-green-500 mr-2"></i>Analisis Jawaban
                    </h2>

                    @if (isset($hasil['analisis']))
                        <div class="prose max-w-none mb-4">
                            <p class="text-gray-700">{{ $hasil['analisis'] }}</p>
                        </div>
                    @endif

                    @if (isset($hasil['jawaban_detail']))
                        <div class="grid md:grid-cols-2 gap-4">
                            @foreach ($hasil['jawaban_detail'] as $pertanyaan => $jawaban)
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <p class="text-sm font-medium text-gray-600 mb-1">{{ $pertanyaan }}</p>
                                    <p class="font-semibold text-gray-800">{{ $jawaban }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            <!-- Saran dan Tindak Lanjut -->
            @if (isset($hasil['saran']))
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800 flex items-center">
                        <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>Saran dan Tindak Lanjut
                    </h2>
                    <div class="space-y-2">
                        @if (is_array($hasil['saran']))
                            @foreach ($hasil['saran'] as $saran)
                                <div class="flex items-start">
                                    <i class="fas fa-arrow-right text-yellow-500 mr-2 mt-1"></i>
                                    <p class="text-gray-700">{{ $saran }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-700">{{ $hasil['saran'] }}</p>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Aksi -->
            <div class="flex flex-wrap gap-4 justify-center no-print">
                <a href="#"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                    <i class="fas fa-redo mr-2"></i>Konsultasi Ulang
                </a>

                <button onclick="window.print()"
                    class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                    <i class="fas fa-print mr-2"></i>Cetak Hasil
                </button>

                <button onclick="downloadPDF()"
                    class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                    <i class="fas fa-file-pdf mr-2"></i>Download PDF
                </button>

                <a href="#"
                    class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                    <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                </a>
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
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

            .container {
                max-width: none !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .shadow-md,
            .shadow-lg {
                box-shadow: none !important;
                border: 1px solid #e5e7eb;
            }
        }
    </style>

    <script>
        function downloadPDF() {
            alert('Fitur download PDF akan segera tersedia');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('[style*="width:"]');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 500);
            });
        });
    </script>
@endsection
