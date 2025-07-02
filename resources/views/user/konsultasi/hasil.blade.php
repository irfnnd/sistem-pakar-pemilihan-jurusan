@extends('layouts.user')

@section('title', 'Hasil Konsultasi')

@section('content')
    <div class="section-area">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class=" bg-primary dark:bg-body-dark-12/10 rounded-lg shadow-lg p-6 mb-8 text-white">
                <h4 class="text-2xl text-white font-bold mb-2">Hasil Konsultasi Pemilihan Jurusan</h4>
                <p class="text-blue-100">Berikut adalah rekomendasi jurusan berdasarkan analisis backward chaining</p>
            </div>

            <!-- Error Message -->
            @if(isset($hasil['error']) && $hasil['error'])
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span>{{ $hasil['message'] ?? 'Terjadi kesalahan dalam analisis' }}</span>
                    </div>
                </div>
            @endif

            <!-- Info Siswa -->
            <div class="dark:bg-body-dark-12/10 rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4  border-b pb-2">
                    <i class="fas fa-user text-blue-500 mr-2"></i>Informasi Siswa
                </h2>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Nama Siswa</label>
                        <p class="text-lg font-semibold">{{ $konsultasi->nama_siswa }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Asal Sekolah</label>
                        <p class="text-lg font-semibold ">{{ $konsultasi->asal_sekolah }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Metode Analisis</label>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                            <i class="fas fa-cogs mr-1"></i>
                            {{ $hasil['metode'] ?? 'Backward Chaining' }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Tanggal Konsultasi</label>
                        <p class="text-lg font-semibold">{{ $konsultasi->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Hasil Rekomendasi -->
            <div class="dark:bg-body-dark-12/10 rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">
                    <i class="fas fa-graduation-cap mr-2 text-primary" ></i>Rekomendasi Jurusan
                </h2>

                @if (isset($hasil['rekomendasi']) && count($hasil['rekomendasi']) > 0)
                    <div class="space-y-6">
                        @foreach ($hasil['rekomendasi'] as $kodeKecerdasan => $item)
                            <div class="border-2 rounded-xl p-6 hover:shadow-lg transition-all duration-300">
                                <!-- Intelligence Type Header -->
                                <div class="mb-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <h3 class="text-lg font-bold">
                                            Kecerdasan: {{ $kodeKecerdasan }}
                                        </h3>
                                        <div class="flex items-center">
                                            <div class="w-20 bg-gray-200 rounded-full h-3 mr-3">
                                                <div class="bg-gradient-to-r from-green-400 to-blue-500 h-3 rounded-full transition-all duration-1000"
                                                     style="width: {{ $item['kecerdasan']['persentase'] }}%">
                                                </div>
                                            </div>
                                            <span class="text-lg font-bold text-gray-700">
                                                {{ $item['kecerdasan']['persentase'] }}%
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Ciri yang Cocok -->
                                @if(!empty($item['kecerdasan']['ciri_cocok']))
                                    <div class="mb-4">
                                        <p class="text-sm font-medium mb-2">Karakteristik yang Sesuai:</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($item['kecerdasan']['ciri_cocok'] as $ciri)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                                    <i class="fas fa-check-circle mr-1 text-green-600"></i>
                                                    {{ $ciri }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Daftar Jurusan -->
                                <div class="space-y-3">
                                    <p class="text-sm font-medium ">Jurusan yang Direkomendasikan:</p>
                                    @foreach ($item['jurusan'] as $jurusan)
                                        <div class="dark:bg-body-dark-12/10 border border-gray-200 rounded-lg p-4 hover:bg-gray-100 transition-colors duration-200">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1">
                                                    <h4 class="text-lg font-semibold  mb-1">
                                                        {{ $jurusan['nama_jurusan'] }}
                                                    </h4>
                                                    @if(!empty($jurusan['deskripsi']))
                                                        <p class=" text-sm mb-2">{{ $jurusan['deskripsi'] }}</p>
                                                    @endif
                                                    <div class="flex items-center text-sm text-gray-500">
                                                        <i class="fas fa-code mr-1"></i>
                                                        <span>Kode: {{ $jurusan['kode_kecerdasan'] }}</span>
                                                    </div>
                                                </div>
                                                <div class="ml-4 flex-shrink-0">
                                                    @php
                                                        $level = 'bg-gray-500';
                                                        $text = 'Cukup Sesuai';
                                                        if($item['kecerdasan']['persentase'] >= 80) {
                                                            $level = 'bg-green-500';
                                                            $text = 'Sangat Sesuai';
                                                        } elseif($item['kecerdasan']['persentase'] >= 65) {
                                                            $level = 'bg-blue-500';
                                                            $text = 'Sesuai';
                                                        } elseif($item['kecerdasan']['persentase'] >= 50) {
                                                            $level = 'bg-yellow-500';
                                                            $text = 'Cukup Sesuai';
                                                        }
                                                    @endphp
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium text-white {{ $level }}">
                                                        {{ $text }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-gray-50 rounded-lg">
                        <i class="fas fa-search text-gray-400 text-5xl mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak Ada Rekomendasi</h3>
                        <p class=" mb-4">
                            Berdasarkan jawaban Anda, sistem tidak dapat memberikan rekomendasi jurusan yang memenuhi kriteria minimum (50%).
                        </p>
                        <div class="space-y-2 text-sm ">
                            <p>• Coba konsultasi ulang dengan menjawab pertanyaan lebih teliti</p>
                            <p>• Konsultasikan dengan guru BK di sekolah</p>
                            <p>• Pertimbangkan untuk mengikuti tes minat bakat yang lebih komprehensif</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Analisis Jawaban -->
            @if (isset($hasil['analisis']) || isset($hasil['jawaban_detail']))
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4  border-b pb-2">
                        <i class="fas fa-chart-bar text-green-500 mr-2"></i>Analisis Jawaban
                    </h2>

                    @if (isset($hasil['analisis']))
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
                            <p class="text-gray-700 leading-relaxed">{{ $hasil['analisis'] }}</p>
                        </div>
                    @endif

                    @if (isset($hasil['jawaban_detail']) && count($hasil['jawaban_detail']) > 0)
                        <div class="mt-4">
                            <h3 class="text-lg font-medium  mb-3">Detail Jawaban:</h3>
                            <div class="grid md:grid-cols-2 gap-3">
                                @foreach ($hasil['jawaban_detail'] as $pertanyaan => $jawaban)
                                    <div class="bg-gray-50 border border-gray-200 p-3 rounded-lg">
                                        <p class="text-sm font-medium  mb-1">{{ $pertanyaan }}</p>
                                        <div class="flex items-center">
                                            @if(strtolower($jawaban) === 'ya')
                                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                                <span class="font-semibold text-green-700">{{ $jawaban }}</span>
                                            @else
                                                <i class="fas fa-times-circle text-red-500 mr-2"></i>
                                                <span class="font-semibold text-red-700">{{ $jawaban }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Saran dan Tindak Lanjut -->
            @if (isset($hasil['saran']) && !empty($hasil['saran']))
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border-l-4 border-yellow-400 rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4  flex items-center">
                        <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>Saran dan Tindak Lanjut
                    </h2>
                    <div class="space-y-3">
                        @if (is_array($hasil['saran']))
                            @foreach ($hasil['saran'] as $index => $saran)
                                <div class="flex items-start">
                                    <span class="flex-shrink-0 w-6 h-6 bg-yellow-500 text-white rounded-full text-xs font-bold flex items-center justify-center mr-3 mt-0.5">
                                        {{ $index + 1 }}
                                    </span>
                                    <p class="text-gray-700 leading-relaxed">{{ $saran }}</p>
                                </div>
                            @endforeach
                        @else
                            <div class="flex items-start">
                                <i class="fas fa-arrow-right text-yellow-500 mr-3 mt-1"></i>
                                <p class="text-gray-700 leading-relaxed">{{ $hasil['saran'] }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Aksi -->
            <div class="dark:bg-body-dark-12/10 rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4  border-b pb-2">
                    <i class="fas fa-tools mr-2 text-primary"></i>Aksi Lanjutan
                </h2>
                <div class="grid md:grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('konsultasi.index') }}"
                       class="inline-flex items-center justify-center px-4 py-3 bg-blue-600 hover:bg-blue-700 hover:text-white text-white font-semibold rounded-lg shadow-md transition duration-200 text-center">
                        <i class="fas fa-redo mr-2"></i>
                        <span>Konsultasi Ulang</span>
                    </a>

                    <button onclick="window.print()"
                            class="inline-flex items-center justify-center px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                        <i class="fas fa-print mr-2"></i>
                        <span>Cetak Hasil</span>
                    </button>

                    <button onclick="downloadPDF()"
                            class="inline-flex items-center justify-center px-4 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                        <i class="fas fa-file-pdf mr-2"></i>
                        <span>Download PDF</span>
                    </button>

                    <a href="{{ route('beranda') }}"
                       class="inline-flex items-center justify-center px-4 py-3 bg-gray-600 hover:bg-gray-700 hover:text-white text-white font-semibold rounded-lg shadow-md transition duration-200 text-center">
                        <i class="fas fa-home mr-2"></i>
                        <span>Beranda</span>
                    </a>
                </div>
            </div>

            <!-- Statistics Summary -->
            @if(isset($hasil['rekomendasi']) && count($hasil['rekomendasi']) > 0)
                <div class="dark:bg-body-dark-12/10 rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4  border-b pb-2">
                        <i class="fas fa-chart-pie mr-2 text-primary"></i>Ringkasan Statistik
                    </h2>
                    <div class="grid md:grid-cols-4 gap-4">
                        <div class="text-center p-4 bg-blue-50 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">{{ count($hasil['rekomendasi']) }}</div>
                            <div class="text-sm ">Tipe Kecerdasan Cocok</div>
                        </div>
                        <div class="text-center p-4 bg-green-50 rounded-lg">
                            @php
                                $totalJurusan = 0;
                                foreach($hasil['rekomendasi'] as $item) {
                                    $totalJurusan += count($item['jurusan']);
                                }
                            @endphp
                            <div class="text-2xl font-bold text-green-600">{{ $totalJurusan }}</div>
                            <div class="text-sm ">Jurusan Direkomendasikan</div>
                        </div>
                        <div class="text-center p-4 bg-yellow-50 rounded-lg">
                            @php
                                $maxPersentase = 0;
                                foreach($hasil['rekomendasi'] as $item) {
                                    $maxPersentase = max($maxPersentase, $item['kecerdasan']['persentase']);
                                }
                            @endphp
                            <div class="text-2xl font-bold text-yellow-600">{{ $maxPersentase }}%</div>
                            <div class="text-sm ">Kesesuaian Tertinggi</div>
                        </div>
                        <div class="text-center p-4 bg-purple-50 rounded-lg">
                            @php
                                $avgPersentase = 0;
                                if(count($hasil['rekomendasi']) > 0) {
                                    $totalPersentase = 0;
                                    foreach($hasil['rekomendasi'] as $item) {
                                        $totalPersentase += $item['kecerdasan']['persentase'];
                                    }
                                    $avgPersentase = round($totalPersentase / count($hasil['rekomendasi']), 1);
                                }
                            @endphp
                            <div class="text-2xl font-bold text-purple-600">{{ $avgPersentase }}%</div>
                            <div class="text-sm ">Rata-rata Kesesuaian</div>
                        </div>
                    </div>
                </div>
            @endif
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
                font-size: 12px;
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

            .bg-gradient-to-r {
                background: #4f46e5 !important;
                color: white !important;
            }

            .rounded-lg {
                border-radius: 8px !important;
            }

            .p-6 {
                padding: 16px !important;
            }

            .mb-6 {
                margin-bottom: 16px !important;
            }

            .text-3xl {
                font-size: 24px !important;
            }

            .text-xl {
                font-size: 18px !important;
            }

            .text-lg {
                font-size: 16px !important;
            }

            /* Print page breaks */
            .page-break {
                page-break-before: always;
            }

            /* Ensure progress bars show in print */
            .bg-gradient-to-r.from-green-400.to-blue-500 {
                background: #10b981 !important;
            }
        }

        /* Progress bar animation */
        .progress-bar {
            transition: width 1s ease-in-out;
        }

        /* Hover effects */
        .hover-scale:hover {
            transform: scale(1.02);
        }

        /* Custom scrollbar for better UX */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>

    <!-- Enhanced JavaScript -->
    <script>
        // PDF Download Function
        function downloadPDF() {
            // Check if jsPDF is available
            if (typeof window.jsPDF !== 'undefined') {
                generatePDF();
            } else {
                // Load jsPDF dynamically
                const script = document.createElement('script');
                script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js';
                script.onload = function() {
                    generatePDF();
                };
                script.onerror = function() {
                    alert('Gagal memuat library PDF. Silakan gunakan fungsi cetak sebagai alternatif.');
                };
                document.head.appendChild(script);
            }
        }

        function generatePDF() {
            try {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Add title
                doc.setFontSize(20);
                doc.text('Hasil Konsultasi Pemilihan Jurusan', 20, 30);

                // Add student info
                doc.setFontSize(12);
                doc.text('Nama Siswa: {{ $konsultasi->nama_siswa }}', 20, 50);
                doc.text('Asal Sekolah: {{ $konsultasi->asal_sekolah }}', 20, 60);
                doc.text('Tanggal: {{ $konsultasi->created_at->format("d M Y, H:i") }}', 20, 70);

                let yPosition = 90;

                @if(isset($hasil['rekomendasi']) && count($hasil['rekomendasi']) > 0)
                    doc.setFontSize(14);
                    doc.text('Rekomendasi Jurusan:', 20, yPosition);
                    yPosition += 20;

                    @foreach($hasil['rekomendasi'] as $kodeKecerdasan => $item)
                        doc.setFontSize(12);
                        doc.text('{{ $kodeKecerdasan }} ({{ $item["kecerdasan"]["persentase"] }}%)', 20, yPosition);
                        yPosition += 10;

                        @foreach($item['jurusan'] as $jurusan)
                            doc.setFontSize(10);
                            doc.text('- {{ $jurusan["nama_jurusan"] }}', 30, yPosition);
                            yPosition += 8;

                            if (yPosition > 250) {
                                doc.addPage();
                                yPosition = 30;
                            }
                        @endforeach
                        yPosition += 5;
                    @endforeach
                @endif

                // Save the PDF
                const fileName = 'Hasil_Konsultasi_{{ $konsultasi->nama_siswa }}_{{ $konsultasi->created_at->format("Y-m-d") }}.pdf';
                doc.save(fileName);

            } catch (error) {
                console.error('Error generating PDF:', error);
                alert('Terjadi kesalahan saat membuat PDF. Silakan gunakan fungsi cetak sebagai alternatif.');
            }
        }

        // Progress bar animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate progress bars
            const progressBars = document.querySelectorAll('.progress-bar, [style*="width:"]');
            progressBars.forEach((bar, index) => {
                const width = bar.style.width || bar.getAttribute('data-width');
                if (width) {
                    bar.style.width = '0%';
                    setTimeout(() => {
                        bar.style.width = width;
                    }, 300 + (index * 100));
                }
            });

            // Add loading animation for recommendations
            const recommendations = document.querySelectorAll('.border-2.border-gray-200');
            recommendations.forEach((rec, index) => {
                rec.style.opacity = '0';
                rec.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    rec.style.transition = 'all 0.5s ease-out';
                    rec.style.opacity = '1';
                    rec.style.transform = 'translateY(0)';
                }, 500 + (index * 200));
            });

            // Add smooth scroll to sections
            const links = document.querySelectorAll('a[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add tooltip functionality
            const tooltips = document.querySelectorAll('[data-tooltip]');
            tooltips.forEach(element => {
                element.addEventListener('mouseenter', function() {
                    const tooltip = document.createElement('div');
                    tooltip.className = 'absolute bg-gray-800 text-white text-sm px-2 py-1 rounded shadow-lg z-50';
                    tooltip.textContent = this.getAttribute('data-tooltip');
                    tooltip.id = 'tooltip';
                    document.body.appendChild(tooltip);

                    const rect = this.getBoundingClientRect();
                    tooltip.style.top = (rect.top - tooltip.offsetHeight - 5) + 'px';
                    tooltip.style.left = (rect.left + rect.width / 2 - tooltip.offsetWidth / 2) + 'px';
                });

                element.addEventListener('mouseleave', function() {
                    const tooltip = document.getElementById('tooltip');
                    if (tooltip) {
                        tooltip.remove();
                    }
                });
            });
        });

        // Print optimization
        window.addEventListener('beforeprint', function() {
            // Ensure all progress bars are fully visible in print
            const progressBars = document.querySelectorAll('[style*="width:"]');
            progressBars.forEach(bar => {
                bar.style.transition = 'none';
            });
        });

        window.addEventListener('afterprint', function() {
            // Restore transitions after print
            const progressBars = document.querySelectorAll('[style*="width:"]');
            progressBars.forEach(bar => {
                bar.style.transition = 'all 0.5s ease-out';
            });
        });

        // Add keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey || e.metaKey) {
                switch(e.key) {
                    case 'p':
                        e.preventDefault();
                        window.print();
                        break;
                    case 's':
                        e.preventDefault();
                        downloadPDF();
                        break;
                }
            }
        });

        // Auto-save consultation results to localStorage for recovery
        @if(isset($hasil) && !isset($hasil['error']))
            const consultationData = {
                student: '{{ $konsultasi->nama_siswa }}',
                school: '{{ $konsultasi->asal_sekolah }}',
                date: '{{ $konsultasi->created_at->format("Y-m-d H:i:s") }}',
                results: @json($hasil),
                timestamp: new Date().toISOString()
            };

            try {
                localStorage.setItem('last_consultation_result', JSON.stringify(consultationData));
            } catch (e) {
                console.warn('Unable to save consultation results to localStorage:', e);
            }
        @endif
    </script>
@endsection
