<!-- resources/views/konsultasi/form.blade.php -->
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Form Konsultasi</h1>
    <a href="{{ route('konsultasi.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<form action="{{ route('konsultasi.proses') }}" method="POST" id="konsultasiForm">
    @csrf

    <div class="row">
        <div class="col-md-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header">
                    <h5>Data Diri</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nama_siswa" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
                    </div>

                    <div class="mb-3">
                        <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                        <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
                    </div>

                    <div class="mb-3">
                        <label for="metode" class="form-label">Metode Analisis</label>
                        <select class="form-select" id="metode" name="metode" required>
                            <option value="">Pilih Metode</option>
                            <option value="forward" {{ request('metode') == 'forward' ? 'selected' : '' }}>Forward Chaining</option>
                            <option value="backward" {{ request('metode') == 'backward' ? 'selected' : '' }}>Backward Chaining</option>
                        </select>
                    </div>

                    <div class="mb-3" id="targetJurusanDiv" style="display: none;">
                        <label for="target_jurusan" class="form-label">Target Jurusan</label>
                        <select class="form-select" id="target_jurusan" name="target_jurusan">
                            <option value="">Pilih Jurusan</option>
                            @foreach($jurusan as $j)
                                <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Analisis
                        </button>
                    </div>

                    <div class="mt-3">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%" id="progressBar"></div>
                        </div>
                        <small class="text-muted">Progress: <span id="progressText">0/{{ $ciriCiri->count() }}</span></small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Pertanyaan Ciri-Ciri Kecerdasan</h5>
                    <p class="mb-0 text-muted">Jawab dengan jujur sesuai dengan kondisi Anda saat ini</p>
                </div>
                <div class="card-body">
                    @foreach($ciriCiri as $index => $ciri)
                        <div class="mb-4 p-3 border rounded">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="mb-2">{{ $index + 1 }}. {{ $ciri->deskripsi }}</h6>
                                </div>
                                <div class="col-md-4">
                                    <div class="btn-group w-100" role="group">
                                        <input type="radio" class="btn-check" name="jawaban[{{ $ciri->kode }}]"
                                               id="ya_{{ $ciri->kode }}" value="ya" onchange="updateProgress()">
                                        <label class="btn btn-outline-success" for="ya_{{ $ciri->kode }}">Ya</label>

                                        <input type="radio" class="btn-check" name="jawaban[{{ $ciri->kode }}]"
                                               id="tidak_{{ $ciri->kode }}" value="tidak" onchange="updateProgress()">
                                        <label class="btn btn-outline-danger" for="tidak_{{ $ciri->kode }}">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
    // Show/hide target jurusan based on metode
    document.getElementById('metode').addEventListener('change', function() {
        const targetDiv = document.getElementById('targetJurusanDiv');
        if (this.value === 'backward') {
            targetDiv.style.display = 'block';
        } else {
            targetDiv.style.display = 'none';
        }
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const metode = document.getElementById('metode').value;
        if (metode === 'backward') {
            document.getElementById('targetJurusanDiv').style.display = 'block';
        }
        updateProgress();
    });

    // Update progress bar
    function updateProgress() {
        const totalQuestions = {{ $ciriCiri->count() }};
        const answeredQuestions = document.querySelectorAll('input[type="radio"]:checked').length;
        const percentage = (answeredQuestions / totalQuestions) * 100;

        document.getElementById('progressBar').style.width = percentage + '%';
        document.getElementById('progressText').textContent = answeredQuestions + '/' + totalQuestions;

        // Enable/disable submit button
        const submitBtn = document.querySelector('button[type="submit"]');
        if (answeredQuestions === totalQuestions) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-search"></i> Analisis';
        } else {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-search"></i> Lengkapi Semua Pertanyaan';
        }
    }
</script>
@endsection
