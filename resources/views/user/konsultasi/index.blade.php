@extends('layouts.user')

@section('content')
{{-- <div class="flex justify-between items-center border-b pb-2 mb-6">
    <h1 class="text-2xl font-semibold">Konsultasi Penentuan Jurusan</h1>
</div> --}}

<div class="flex justify-center">
    <div class="w-full max-w-7xl">
        <div class="bg-white rounded-xl p-10 text-center">
            <i class="fas fa-graduation-cap text-indigo-500 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Selamat Datang di Sistem Pakar Penentuan Jurusan</h3>
            <p class="text-gray-600 mb-6">
                Sistem ini akan membantu Anda menentukan jurusan kuliah yang sesuai dengan minat dan bakat berdasarkan analisis kecerdasan majemuk.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Forward Chaining -->
                <div class="border border-indigo-500 rounded-xl p-6 shadow-sm">
                    <i class="fas fa-arrow-right text-indigo-500 text-3xl mb-4"></i>
                    <h5 class="text-lg font-semibold mb-2">Forward Chaining</h5>
                    <p class="text-gray-600 mb-4">
                        Analisis berdasarkan ciri-ciri yang Anda miliki untuk menemukan kecerdasan dominan dan rekomendasi jurusan.
                    </p>
                    <a href="{{ route('konsultasi.form') }}?metode=forward"
                       class="inline-block px-4 py-2 bg-indigo-500 text-white font-semibold rounded hover:bg-indigo-600 transition">
                        Mulai Konsultasi
                    </a>
                </div>

                <!-- Backward Chaining -->
                <div class="border border-green-500 rounded-xl p-6 shadow-sm">
                    <i class="fas fa-arrow-left text-green-500 text-3xl mb-4"></i>
                    <h5 class="text-lg font-semibold mb-2">Backward Chaining</h5>
                    <p class="text-gray-600 mb-4">
                        Analisis kesesuaian Anda dengan jurusan tertentu yang sudah Anda pilih atau minati.
                    </p>
                    <a href="{{ route('konsultasi.form') }}?metode=backward"
                       class="inline-block px-4 py-2 bg-green-500 text-white font-semibold rounded hover:bg-green-600 transition">
                        Mulai Konsultasi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
