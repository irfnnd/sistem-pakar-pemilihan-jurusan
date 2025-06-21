<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CiriCiri;
use App\Models\Kecerdasan;
use App\Models\Jurusan;
use App\Models\Konsultasi;
use App\Services\ForwardChainingService;
use App\Services\BackwardChainingService;

class KonsultasiController extends Controller
{
    protected $forwardChaining;
    protected $backwardChaining;

    public function __construct(
        ForwardChainingService $forwardChaining,
        BackwardChainingService $backwardChaining
    ) {
        $this->forwardChaining = $forwardChaining;
        $this->backwardChaining = $backwardChaining;
    }

    public function index()
    {
        return view('konsultasi.index');
    }

    public function form()
    {
        $ciriCiri = CiriCiri::all();
        $jurusan = Jurusan::all();

        return view('konsultasi.form', compact('ciriCiri', 'jurusan'));
    }

    public function proses(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'metode' => 'required|in:forward,backward',
            'jawaban' => 'required|array',
            'target_jurusan' => 'nullable|exists:jurusan,id'
        ]);

        $jawabanSiswa = $request->input('jawaban');
        $metode = $request->input('metode');

        if ($metode === 'forward') {
            $hasil = $this->forwardChaining->proses($jawabanSiswa);
        } else {
            $targetJurusan = $request->input('target_jurusan');
            $hasil = $this->backwardChaining->proses($jawabanSiswa, $targetJurusan);
        }

        // Simpan hasil konsultasi
        $konsultasi = Konsultasi::create([
            'nama_siswa' => $request->input('nama_siswa'),
            'asal_sekolah' => $request->input('asal_sekolah'),
            'jawaban' => $jawabanSiswa,
            'hasil' => $hasil,
            'metode' => $metode
        ]);


        return view('konsultasi.hasil', compact('hasil', 'konsultasi'));
    }

    public function riwayat()
    {
        $riwayatKonsultasi = Konsultasi::orderBy('created_at', 'desc')->paginate(10);
        return view('konsultasi.riwayat', compact('riwayatKonsultasi'));
    }

    public function detail($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        return view('konsultasi.detail', compact('konsultasi'));
    }
}
