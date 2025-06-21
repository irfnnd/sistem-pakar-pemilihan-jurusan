@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center border-b pb-2 mb-6">
    <h1 class="text-2xl font-semibold">Dashboard</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-indigo-500 text-white rounded-xl shadow p-4">
        <div class="flex justify-between items-center">
            <div>
                <h5 class="text-sm">Total Konsultasi</h5>
                <h2 class="text-2xl font-bold">{{ $totalKonsultasi }}</h2>
            </div>
            <i class="fas fa-comments fa-2x"></i>
        </div>
    </div>

    <div class="bg-green-500 text-white rounded-xl shadow p-4">
        <div class="flex justify-between items-center">
            <div>
                <h5 class="text-sm">Jenis Kecerdasan</h5>
                <h2 class="text-2xl font-bold">{{ $totalKecerdasan }}</h2>
            </div>
            <i class="fas fa-brain fa-2x"></i>
        </div>
    </div>

    <div class="bg-yellow-400 text-white rounded-xl shadow p-4">
        <div class="flex justify-between items-center">
            <div>
                <h5 class="text-sm">Total Jurusan</h5>
                <h2 class="text-2xl font-bold">{{ $totalJurusan }}</h2>
            </div>
            <i class="fas fa-graduation-cap fa-2x"></i>
        </div>
    </div>

    <div class="bg-blue-400 text-white rounded-xl shadow p-4">
        <div class="flex justify-between items-center">
            <div>
                <h5 class="text-sm">Ciri-Ciri</h5>
                <h2 class="text-2xl font-bold">{{ $totalCiriCiri }}</h2>
            </div>
            <i class="fas fa-list fa-2x"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow p-4">
        <h5 class="text-lg font-semibold mb-4">Statistik Metode</h5>
        <div class="relative h-64">
            <canvas id="metodeChart"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-4">
        <h5 class="text-lg font-semibold mb-4">Konsultasi Terbaru</h5>

        @if($konsultasiTerbaru->count() > 0)
            @foreach($konsultasiTerbaru as $konsultasi)
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <strong>{{ $konsultasi->nama_siswa }}</strong><br>
                        <span class="text-gray-500 text-sm">{{ $konsultasi->asal_sekolah }}</span>
                    </div>
                    <div class="text-right">
                        <span class="px-2 py-1 rounded-full text-sm font-semibold
                            {{ $konsultasi->metode == 'forward' ? 'bg-indigo-500 text-white' : 'bg-green-500 text-white' }}">
                            {{ ucfirst($konsultasi->metode) }}
                        </span><br>
                        <small class="text-gray-400">{{ $konsultasi->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                </div>
                @if(!$loop->last)
                    <hr class="border-gray-200 my-2">
                @endif
            @endforeach
        @else
            <p class="text-gray-500">Belum ada konsultasi</p>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
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
