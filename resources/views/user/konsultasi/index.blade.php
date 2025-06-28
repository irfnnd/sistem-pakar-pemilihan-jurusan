@extends('layouts.user')

@section('content')
{{-- <div class="flex justify-between items-center border-b pb-2 mb-6">
    <h1 class="text-2xl font-semibold">Konsultasi Penentuan Jurusan</h1>
</div> --}}
    <div class="section-area px-8" style="padding-top: 9rem">
        <div class="w-full max-w-7xl">
            <div class="bg-white rounded-xl p-10 text-center">
                <i class="fas fa-graduation-cap text-indigo-500 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Selamat Datang di Sistem Pakar Penentuan Jurusan</h3>
                <p class="text-gray-600 mb-6">
                    Sistem ini akan membantu Anda menentukan jurusan kuliah yang sesuai dengan minat dan bakat berdasarkan analisis kecerdasan majemuk.
                </p>

                <div class="flex flex-wrap justify-center gap-4 mt-16">
                    <!-- Forward Chaining -->
                    <div class="border border-indigo-500 rounded-xl p-4 shadow-card-1 max-w-[780px]">
                        <i class="fas fa-arrow-right text-indigo-500 text-3xl mb-4"></i>
                        <h5 class="text-lg font-semibold mb-2">Forward Chaining</h5>
                        <p class="text-gray-600 mb-4">
                            Analisis berdasarkan ciri-ciri yang Anda miliki untuk menemukan kecerdasan dominan dan rekomendasi jurusan.
                        </p>
                        <a href="{{ route('konsultasi.form') }}?metode=forward"
                           class="inline-flex items-center justify-center rounded-md bg-primary text-primary-color px-5 py-3 text-base font-medium shadow-md hover:bg-primary-light-5"
                           role="button">
                            Mulai Konsultasi
                        </a>
                    </div>

                    <!-- Backward Chaining -->
                    <div class="border border-green-500 rounded-xl p-4 shadow-card-1 max-w-[780px]">
                        <i class="fas fa-arrow-left text-green-500 text-3xl mb-4"></i>
                        <h5 class="text-lg font-semibold mb-2">Backward Chaining</h5>
                        <p class="text-gray-600 mb-4">
                            Analisis kesesuaian Anda dengan jurusan tertentu yang sudah Anda pilih atau minati.
                        </p>
                        <a href="{{ route('konsultasi.form') }}?metode=backward"
                           class="inline-flex items-center justify-center rounded-md bg-primary text-primary-color px-5 py-3 text-base font-medium shadow-md hover:bg-primary-light-5">
                            Mulai Konsultasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
