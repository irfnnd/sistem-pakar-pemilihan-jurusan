@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Total Konsultasi</h5>
                        <h2>{{ $totalKonsultasi }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-comments fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Jenis Kecerdasan</h5>
                        <h2>{{ $totalKecerdasan }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-brain fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Total Jurusan</h5>
                        <h2>{{ $totalJurusan }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-graduation-cap fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Ciri-Ciri</h5>
                        <h2>{{ $totalCiriCiri }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-list fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Statistik Metode</h5>
            </div>
            <div class="card-body">
                <canvas id="metodeChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Konsultasi Terbaru</h5>
            </div>
            <div class="card-body">
                @if($konsultasiTerbaru->count() > 0)
                    @foreach($konsultasiTerbaru as $konsultasi)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <strong>{{ $konsultasi->nama_siswa }}</strong><br>
                                <small class="text-muted">{{ $konsultasi->asal_sekolah }}</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-{{ $konsultasi->metode == 'forward' ? 'primary' : 'success' }}">
                                    {{ ucfirst($konsultasi->metode) }}
                                </span><br>
                                <small class="text-muted">{{ $konsultasi->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                        </div>
                        @if(!$loop->last)
                            <hr>
                        @endif
                    @endforeach
                @else
                    <p class="text-muted">Belum ada konsultasi</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart untuk metode
    const ctx = document.getElementById('metodeChart').getContext('2d');
    const metodeChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Forward Chaining', 'Backward Chaining'],
            datasets: [{
                data: [{{ $forwardCount }}, {{ $backwardCount }}],
                backgroundColor: ['#667eea', '#764ba2']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endsection
