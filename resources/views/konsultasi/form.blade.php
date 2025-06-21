@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center border-b pb-2 mb-6">
    <h1 class="text-2xl font-semibold">Form Konsultasi</h1>
    <a href="{{ route('konsultasi.index') }}"
       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded hover:bg-gray-100 text-gray-700">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
</div>

<form action="{{ route('konsultasi.proses') }}" method="POST" id="konsultasiForm">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Form Side (Data Diri) -->
        <div class="md:col-span-1">
            <div class="bg-white p-4 rounded-lg shadow sticky top-6">
                <h5 class="text-lg font-semibold mb-4 border-b pb-2">Data Diri</h5>

                <div class="mb-4">
                    <label for="nama_siswa" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" id="nama_siswa" name="nama_siswa"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-indigo-200"
                           required>
                </div>

                <div class="mb-4">
                    <label for="asal_sekolah" class="block text-sm font-medium text-gray-700 mb-1">Asal Sekolah</label>
                    <input type="text" id="asal_sekolah" name="asal_sekolah"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-indigo-200"
                           required>
                </div>

                <div class="mb-4">
                    <label for="metode" class="block text-sm font-medium text-gray-700 mb-1">Metode Analisis</label>
                    <select id="metode" name="metode"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-indigo-200"
                            required>
                        <option value="">Pilih Metode</option>
                        <option value="forward" {{ request('metode') == 'forward' ? 'selected' : '' }}>Forward Chaining</option>
                        <option value="backward" {{ request('metode') == 'backward' ? 'selected' : '' }}>Backward Chaining</option>
                    </select>
                </div>

                <div class="mb-4 hidden" id="targetJurusanDiv">
                    <label for="target_jurusan" class="block text-sm font-medium text-gray-700 mb-1">Target Jurusan</label>
                    <select id="target_jurusan" name="target_jurusan"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-indigo-200">
                        <option value="">Pilih Jurusan</option>
                        @foreach($jurusan as $j)
                            <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700 transition disabled:opacity-50"
                        disabled>
                    <i class="fas fa-search mr-1"></i> Analisis
                </button>

                <div class="mt-4">
                    <div class="w-full bg-gray-200 rounded-full h-2 mb-1">
                        <div class="bg-indigo-500 h-2 rounded-full transition-all duration-300"
                             id="progressBar" style="width: 0%"></div>
                    </div>
                    <small class="text-gray-500">Progress:
                        <span id="progressText">0/{{ $ciriCiri->count() }}</span></small>
                </div>
            </div>
        </div>

        <!-- Pertanyaan -->
        <div class="md:col-span-2">
            <div class="bg-white p-4 rounded-lg shadow">
                <h5 class="text-lg font-semibold mb-2">Pertanyaan Ciri-Ciri Kecerdasan</h5>
                <p class="text-sm text-gray-500 mb-4">Jawab dengan jujur sesuai dengan kondisi Anda saat ini.</p>

                @foreach($ciriCiri as $index => $ciri)
    <div class="mb-4 p-4 border rounded" id="container-{{ $ciri->kode }}">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h6 class="text-base font-medium text-gray-800 flex-1">
                {{ $index + 1 }}. {{ $ciri->deskripsi }}
            </h6>
            <div class="flex gap-2">
                <label id="label-ya-{{ $ciri->kode }}"
                    class="px-4 py-2 border rounded cursor-pointer bg-white text-gray-800 hover:bg-green-500 duration-200 hover:text-white">
                    <input type="radio" name="jawaban[{{ $ciri->kode }}]"
                        value="ya"
                        class="hidden"
                        onchange="updateProgress(); setActive('{{ $ciri->kode }}', 'ya')">
                    Ya
                </label>

                <label id="label-tidak-{{ $ciri->kode }}"
                    class="px-4 py-2 border rounded cursor-pointer bg-white text-gray-800 hover:bg-red-500 duration-400 hover:text-white">
                    <input type="radio" name="jawaban[{{ $ciri->kode }}]"
                        value="tidak"
                        class="hidden"
                        onchange="updateProgress(); setActive('{{ $ciri->kode }}', 'tidak')">
                    Tidak
                </label>
            </div>
        </div>
    </div>
@endforeach

            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
    // Show/hide target jurusan based on metode
    document.getElementById('metode').addEventListener('change', function () {
        const targetDiv = document.getElementById('targetJurusanDiv');
        if (this.value === 'backward') {
            targetDiv.classList.remove('hidden');
        } else {
            targetDiv.classList.add('hidden');
        }
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function () {
        const metode = document.getElementById('metode').value;
        if (metode === 'backward') {
            document.getElementById('targetJurusanDiv').classList.remove('hidden');
        }
        updateProgress();
    });

    function updateProgress() {
        const total = {{ $ciriCiri->count() }};
        const answered = document.querySelectorAll('input[type="radio"]:checked').length;
        const percent = (answered / total) * 100;

        document.getElementById('progressBar').style.width = percent + '%';
        document.getElementById('progressText').textContent = `${answered}/${total}`;

        const submitBtn = document.querySelector('button[type="submit"]');
        if (answered === total) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-search mr-1"></i> Analisis';
        } else {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-search mr-1"></i> Lengkapi Semua Pertanyaan';
        }
    }
</script>
<script>
    function setActive(kode, pilihan) {
        const yaLabel = document.getElementById(`label-ya-${kode}`);
        const tidakLabel = document.getElementById(`label-tidak-${kode}`);

        if (pilihan === 'ya') {
            yaLabel.classList.remove('bg-white', 'text-gray-800');
            yaLabel.classList.add('bg-green-500', 'text-white');

            tidakLabel.classList.remove('bg-red-500', 'text-white');
            tidakLabel.classList.add('bg-white', 'text-gray-800');
        } else {
            tidakLabel.classList.remove('bg-white', 'text-gray-800');
            tidakLabel.classList.add('bg-red-500', 'text-white');

            yaLabel.classList.remove('bg-green-500', 'text-white');
            yaLabel.classList.add('bg-white', 'text-gray-800');
        }
    }
</script>

@endsection
