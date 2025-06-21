<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsultasi;
use App\Models\Kecerdasan;
use App\Models\Jurusan;
use App\Models\CiriCiri;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKonsultasi = Konsultasi::count();
        $totalKecerdasan = Kecerdasan::count();
        $totalJurusan = Jurusan::count();
        $totalCiriCiri = CiriCiri::count();

        // Statistik metode yang digunakan
        $forwardCount = Konsultasi::where('metode', 'forward')->count();
        $backwardCount = Konsultasi::where('metode', 'backward')->count();

        // Kecerdasan yang paling sering muncul
        $kecerdasanPopuler = Konsultasi::selectRaw('
            JSON_UNQUOTE(JSON_EXTRACT(hasil, "$.rekomendasi")) as rekomendasi
        ')
        ->whereNotNull('hasil')
        ->get();

        $konsultasiTerbaru = Konsultasi::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalKonsultasi',
            'totalKecerdasan',
            'totalJurusan',
            'totalCiriCiri',
            'forwardCount',
            'backwardCount',
            'konsultasiTerbaru'
        ));
    }
}
