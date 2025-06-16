@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Konsultasi Penentuan Jurusan</h1>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-graduation-cap fa-5x text-primary mb-4"></i>
                <h3>Selamat Datang di Sistem Pakar Penentuan Jurusan</h3>
                <p class="lead">Sistem ini akan membantu Anda menentukan jurusan kuliah yang sesuai dengan minat dan bakat berdasarkan analisis kecerdasan majemuk.</p>

                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <div class="card border-primary">
                            <div class="card-body">
                                <i class="fas fa-arrow-right fa-2x text-primary mb-3"></i>
                                <h5>Forward Chaining</h5>
                                <p>Analisis berdasarkan ciri-ciri yang Anda miliki untuk menemukan kecerdasan dominan dan rekomendasi jurusan.</p>
                                <a href="{{ route('konsultasi.form') }}?metode=forward" class="btn btn-primary">
                                    Mulai Konsultasi
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="card border-success">
                            <div class="card-body">
                                <i class="fas fa-arrow-left fa-2x text-success mb-3"></i>
                                <h5>Backward Chaining</h5>
                                <p>Analisis kesesuaian Anda dengan jurusan tertentu yang sudah Anda pilih atau minati.</p>
                                <a href="{{ route('konsultasi.form') }}?metode=backward" class="btn btn-success">
                                    Mulai Konsultasi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
