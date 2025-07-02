@extends('layouts.user')

@section('content')
<div class="section-area dark:bg-body-dark-12/10" style="padding-top: 9rem">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto ">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-primary rounded-full mb-6 shadow-lg">
                    <i class="fas fa-graduation-cap text-white text-3xl"></i>
                </div>
                <h1 class="text-4xl font-bold mb-4">
                    Sistem Pakar Penentuan Jurusan
                </h1>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Temukan jurusan kuliah yang tepat untuk masa depan Anda! Sistem ini menganalisis minat dan bakat berdasarkan teori kecerdasan majemuk untuk memberikan rekomendasi jurusan yang sesuai dengan potensi Anda.
                </p>
            </div>

            <!-- Consultation Methods -->
            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <!-- Forward Chaining Card -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-3 border border-gray-100 hover:border-indigo-200">
                    <div class="flex flex-col items-center text-center h-full">
                        <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-md">
                            <i class="fas fa-search text-white text-2xl"></i>
                        </div>

                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Forward Chaining</h3>
                        <p class="text-gray-600 mb-6 flex-grow leading-relaxed">
                            Mulai dari karakteristik dan minat Anda, sistem akan menganalisis pola untuk menemukan kecerdasan dominan dan merekomendasikan jurusan yang paling sesuai.
                        </p>

                        <div class="w-full">
                            <div class="bg-primary/10 rounded-lg p-4 mb-6">
                                <h4 class="font-semibold  mb-2">Proses Analisis:</h4>
                                <ul class="text-sm  space-y-1">
                                    <li>• Identifikasi karakteristik personal</li>
                                    <li>• Analisis pola kecerdasan</li>
                                    <li>• Rekomendasi jurusan terbaik</li>
                                </ul>
                            </div>

                            <a href="{{ route('konsultasi.form') }}?metode=forward"
                               class="w-full inline-flex items-center justify-center bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-primary-light-5 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                                <i class="fas fa-play mr-2"></i>
                                Mulai Eksplorasi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Backward Chaining Card -->
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-3 border border-gray-100 hover:border-indigo-200 ">
                    <div class="flex flex-col items-center text-center h-full">
                        <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-md">
                            <i class="fas fa-bullseye text-white text-2xl"></i>
                        </div>

                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Backward Chaining</h3>
                        <p class="text-gray-600 mb-6 flex-grow leading-relaxed">
                            Sudah memiliki jurusan impian? Sistem akan menganalisis kesesuaian karakteristik Anda dengan jurusan pilihan untuk memastikan kecocokan yang optimal.
                        </p>

                        <div class="w-full">
                            <div class="bg-primary/10 rounded-lg p-4 mb-6">
                                <h4 class="font-semibold text-emerald-800 mb-2">Proses Verifikasi:</h4>
                                <ul class="text-sm text-emerald-700 space-y-1">
                                    <li>• Pilih jurusan target</li>
                                    <li>• Analisis kesesuaian profil</li>
                                    <li>• Evaluasi tingkat kecocokan</li>
                                </ul>
                            </div>

                            <a href="{{ route('konsultasi.form') }}?metode=backward"
                               class="w-full inline-flex items-center justify-center bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-primary-light-5 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                                <i class="fas fa-check-circle mr-2"></i>
                                Verifikasi Pilihan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 mb-12">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">Keunggulan Sistem Kami</h2>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-blue-500 rounded-lg mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-brain text-white"></i>
                        </div>
                        <h4 class="font-semibold text-gray-800 mb-2">Analisis Mendalam</h4>
                        <p class="text-sm text-gray-600">Berdasarkan teori kecerdasan majemuk Howard Gardner</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-purple-500 rounded-lg mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                        <h4 class="font-semibold text-gray-800 mb-2">Akurasi Tinggi</h4>
                        <p class="text-sm text-gray-600">Sistem pakar dengan algoritma forward & backward chaining</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-green-500 rounded-lg mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-lightbulb text-white"></i>
                        </div>
                        <h4 class="font-semibold text-gray-800 mb-2">Rekomendasi Personal</h4>
                        <p class="text-sm text-gray-600">Saran jurusan yang disesuaikan dengan profil unik Anda</p>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center">
                <div class="bg-primary rounded-2xl p-8 text-white">
                    <h3 class="text-2xl font-bold text-white mb-4">Siap Menemukan Jurusan Impian Anda?</h3>
                    <p class="text-indigo-100 mb-6 max-w-2xl mx-auto">
                        Jangan biarkan keraguan menghalangi masa depan cemerlang Anda. Mulai konsultasi sekarang dan temukan jalan menuju karir yang sesuai dengan passion Anda!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('konsultasi.form') }}?metode=forward"
                           class="bg-primary-color text-indigo-600 px-8 py-3 rounded-xl font-semibold  hover:bg-primary-light-5 transition-all duration-300 shadow-lg">
                            Eksplorasi Minat Saya
                        </a>
                        <a href="{{ route('konsultasi.form') }}?metode=backward"
                           class="border-2 border-white text-white px-8 py-3 rounded-xl font-semibold hover:bg-white hover:text-indigo-600 transition-all duration-300">
                            Cek Jurusan Pilihan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
