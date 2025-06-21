<?php

namespace App\Services;

use App\Models\Kecerdasan;
use App\Models\Jurusan;
use App\Models\Rule;
use App\Models\CiriCiri;

class ForwardChainingService
{
    public function proses($jawabanSiswa)
    {
        $hasilAnalisis = [];
        $skorKecerdasan = [];

        // Ambil semua kecerdasan
        $semuaKecerdasan = Kecerdasan::all();

        foreach ($semuaKecerdasan as $kecerdasan) {
            $skorKecerdasan[$kecerdasan->kode] = [
                'nama' => $kecerdasan->nama_kecerdasan,
                'skor' => 0,
                'total_ciri' => 0,
                'ciri_cocok' => []
            ];
        }

        // Hitung skor berdasarkan jawaban
        foreach ($jawabanSiswa as $kodeCiri => $jawaban) {
            if ($jawaban === 'ya') {
                // Cari rule yang mengandung ciri ini
                $rules = Rule::where('kode_ciri', $kodeCiri)->get();

                foreach ($rules as $rule) {
                    $skorKecerdasan[$rule->kode_kecerdasan]['skor']++;
                    $skorKecerdasan[$rule->kode_kecerdasan]['ciri_cocok'][] = $kodeCiri;
                }
            }
        }

        // Hitung total ciri untuk setiap kecerdasan
        foreach ($semuaKecerdasan as $kecerdasan) {
            $totalCiri = Rule::where('kode_kecerdasan', $kecerdasan->kode)->count();
            $skorKecerdasan[$kecerdasan->kode]['total_ciri'] = $totalCiri;

            // Hitung persentase
            if ($totalCiri > 0) {
                $skorKecerdasan[$kecerdasan->kode]['persentase'] =
                    ($skorKecerdasan[$kecerdasan->kode]['skor'] / $totalCiri) * 100;
            } else {
                $skorKecerdasan[$kecerdasan->kode]['persentase'] = 0;
            }
        }

        // Urutkan berdasarkan skor tertinggi
        uasort($skorKecerdasan, function($a, $b) {
            return $b['persentase'] <=> $a['persentase'];
        });

        // Ambil 3 kecerdasan teratas
        $topKecerdasan = array_slice($skorKecerdasan, 0, 3, true);

        // Ambil jurusan yang sesuai
        $rekomendasiJurusan = [];
        foreach ($topKecerdasan as $kodeKecerdasan => $dataKecerdasan) {
            if ($dataKecerdasan['persentase'] > 0) {
                $jurusan = Jurusan::where('kode_kecerdasan', $kodeKecerdasan)->get();
                $rekomendasiJurusan[$kodeKecerdasan] = [
                    'kecerdasan' => $dataKecerdasan,
                    'jurusan' => $jurusan->toArray()
                ];
            }
        }

        return [
            'metode' => 'Forward Chaining',
            'skor_kecerdasan' => $skorKecerdasan,
            'rekomendasi' => $rekomendasiJurusan
        ];
    }
}
