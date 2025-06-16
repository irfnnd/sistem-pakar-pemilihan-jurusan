<?php

namespace App\Services;

use App\Models\Kecerdasan;
use App\Models\Jurusan;
use App\Models\Rule;

class BackwardChainingService
{
    public function proses($jawabanSiswa, $targetJurusan = null)
    {
        $hasilAnalisis = [];

        if ($targetJurusan) {
            // Backward chaining untuk jurusan tertentu
            return $this->prosesJurusanTertentu($jawabanSiswa, $targetJurusan);
        } else {
            // Backward chaining untuk semua jurusan
            return $this->prosesSemuaJurusan($jawabanSiswa);
        }
    }

    private function prosesJurusanTertentu($jawabanSiswa, $targetJurusan)
    {
        $jurusan = Jurusan::find($targetJurusan);
        if (!$jurusan) {
            return ['error' => 'Jurusan tidak ditemukan'];
        }

        // Ambil semua ciri untuk kecerdasan yang terkait dengan jurusan ini
        $rules = Rule::where('kode_kecerdasan', $jurusan->kode_kecerdasan)->get();

        $ciriYangDiperlukan = $rules->pluck('kode_ciri')->toArray();
        $ciriYangTerpenuhi = [];

        foreach ($ciriYangDiperlukan as $kodeCiri) {
            if (isset($jawabanSiswa[$kodeCiri]) && $jawabanSiswa[$kodeCiri] === 'ya') {
                $ciriYangTerpenuhi[] = $kodeCiri;
            }
        }

        $persentaseKesesuaian = (count($ciriYangTerpenuhi) / count($ciriYangDiperlukan)) * 100;

        return [
            'metode' => 'Backward Chaining',
            'target_jurusan' => $jurusan->nama_jurusan,
            'kecerdasan_terkait' => $jurusan->kecerdasan->nama_kecerdasan,
            'total_ciri_diperlukan' => count($ciriYangDiperlukan),
            'ciri_terpenuhi' => count($ciriYangTerpenuhi),
            'persentase_kesesuaian' => $persentaseKesesuaian,
            'ciri_yang_terpenuhi' => $ciriYangTerpenuhi,
            'rekomendasi' => $persentaseKesesuaian >= 50 ? 'Sesuai' : 'Kurang Sesuai'
        ];
    }

    private function prosesSemuaJurusan($jawabanSiswa)
    {
        $semuaJurusan = Jurusan::with('kecerdasan')->get();
        $hasilAnalisis = [];

        foreach ($semuaJurusan as $jurusan) {
            $hasil = $this->prosesJurusanTertentu($jawabanSiswa, $jurusan->id);
            $hasilAnalisis[] = array_merge($hasil, [
                'id_jurusan' => $jurusan->id,
                'nama_jurusan' => $jurusan->nama_jurusan
            ]);
        }

        // Urutkan berdasarkan persentase kesesuaian
        usort($hasilAnalisis, function($a, $b) {
            return $b['persentase_kesesuaian'] <=> $a['persentase_kesesuaian'];
        });

        return [
            'metode' => 'Backward Chaining',
            'hasil_analisis' => array_slice($hasilAnalisis, 0, 10) // Ambil 10 teratas
        ];
    }
}
