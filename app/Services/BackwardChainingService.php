<?php

namespace App\Services;

use App\Models\Kecerdasan;
use App\Models\Jurusan;
use App\Models\Rule;
use App\Models\Ciri;
use App\Models\CiriCiri;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class BackwardChainingService
{
    private const MINIMUM_THRESHOLD = 50; // Minimum percentage for recommendation
    private const MAX_RECOMMENDATIONS = 10; // Maximum number of recommendations to return

    /**
     * Process backward chaining analysis
     *
     * @param array $jawabanSiswa Student's answers
     * @param int|null $targetJurusan Target major ID (optional)
     * @return array Analysis results
     */
    public function proses($jawabanSiswa, $targetJurusan = null)
    {
        try {
            // Validate input
            if (empty($jawabanSiswa) || !is_array($jawabanSiswa)) {
                return $this->errorResponse('Invalid input data');
            }

            if ($targetJurusan) {
                return $this->prosesJurusanTertentu($jawabanSiswa, $targetJurusan);
            } else {
                return $this->prosesSemuaJurusan($jawabanSiswa);
            }
        } catch (\Exception $e) {
            Log::error('Backward Chaining Error: ' . $e->getMessage());
            return $this->errorResponse('An error occurred during analysis');
        }
    }

    /**
     * Process specific major analysis
     *
     * @param array $jawabanSiswa Student's answers
     * @param int $targetJurusan Target major ID
     * @return array Analysis result
     */
    private function prosesJurusanTertentu($jawabanSiswa, $targetJurusan)
    {
        $jurusan = Jurusan::with('kecerdasan')->find($targetJurusan);

        if (!$jurusan) {
            return $this->errorResponse('Jurusan tidak ditemukan');
        }

        // Get all rules for this major's intelligence type
        $rules = Rule::with('ciri')
            ->where('kode_kecerdasan', $jurusan->kode_kecerdasan)
            ->get();

        if ($rules->isEmpty()) {
            return $this->errorResponse('Rules not found for this major');
        }

        $analisisKecerdasan = $this->analisisKecerdasan($jawabanSiswa, $jurusan->kode_kecerdasan);

        return [
            'metode' => 'Backward Chaining',
            'target_jurusan' => [
                'id' => $jurusan->id,
                'nama' => $jurusan->nama_jurusan,
                'deskripsi' => $jurusan->deskripsi ?? '',
                'kode_kecerdasan' => $jurusan->kode_kecerdasan
            ],
            'kecerdasan_terkait' => $jurusan->kecerdasan->nama_kecerdasan ?? 'Unknown',
            'analisis' => $analisisKecerdasan,
            'rekomendasi' => $this->generateRecommendation($analisisKecerdasan['persentase']),
            'saran' => $this->generateSuggestions($analisisKecerdasan['persentase'], $jurusan->nama_jurusan),
            'timestamp' => now()->toDateTimeString()
        ];
    }

    /**
     * Process all majors analysis
     *
     * @param array $jawabanSiswa Student's answers
     * @return array Analysis results
     */
    private function prosesSemuaJurusan($jawabanSiswa)
    {
        $semuaJurusan = Jurusan::with('kecerdasan')->get();
        $hasilAnalisis = [];
        $rekomendasi = [];

        // Group majors by intelligence type for efficient processing
        $jurusanByKecerdasan = $semuaJurusan->groupBy('kode_kecerdasan');

        foreach ($jurusanByKecerdasan as $kodeKecerdasan => $jurusanList) {
            $analisisKecerdasan = $this->analisisKecerdasan($jawabanSiswa, $kodeKecerdasan);

            // Only include if meets minimum threshold
            if ($analisisKecerdasan['persentase'] >= self::MINIMUM_THRESHOLD) {
                $jurusanArray = [];
                foreach ($jurusanList as $jurusan) {
                    $jurusanArray[] = [
                        'id' => $jurusan->id,
                        'nama_jurusan' => $jurusan->nama_jurusan,
                        'deskripsi' => $jurusan->deskripsi ?? '',
                        'kode_kecerdasan' => $jurusan->kode_kecerdasan
                    ];
                }

                $rekomendasi[$kodeKecerdasan] = [
                    'kecerdasan' => $analisisKecerdasan,
                    'jurusan' => $jurusanArray
                ];
            }
        }

        // Sort by percentage (descending)
        uasort($rekomendasi, function($a, $b) {
            return $b['kecerdasan']['persentase'] <=> $a['kecerdasan']['persentase'];
        });

        // Limit recommendations
        $rekomendasi = array_slice($rekomendasi, 0, self::MAX_RECOMMENDATIONS, true);

        return [
            'metode' => 'Backward Chaining',
            'rekomendasi' => $rekomendasi,
            'analisis' => $this->generateOverallAnalysis($rekomendasi, $jawabanSiswa),
            'saran' => $this->generateOverallSuggestions($rekomendasi),
            'jawaban_detail' => $this->formatAnswerDetails($jawabanSiswa),
            'timestamp' => now()->toDateTimeString()
        ];
    }

    /**
     * Analyze intelligence type based on student answers
     *
     * @param array $jawabanSiswa Student's answers
     * @param string $kodeKecerdasan Intelligence code
     * @return array Analysis result
     */
    private function analisisKecerdasan($jawabanSiswa, $kodeKecerdasan)
    {
        $rules = Rule::with('ciri')
            ->where('kode_kecerdasan', $kodeKecerdasan)
            ->get();

        $ciriYangDiperlukan = $rules->pluck('kode_ciri')->unique()->toArray();
        $ciriYangTerpenuhi = [];
        $ciriCocokDetail = [];

        foreach ($ciriYangDiperlukan as $kodeCiri) {
            if (isset($jawabanSiswa[$kodeCiri]) && $jawabanSiswa[$kodeCiri] === 'ya') {
                $ciriYangTerpenuhi[] = $kodeCiri;

                // Get ciri name for display
                $ciri = $rules->firstWhere('kode_ciri', $kodeCiri)?->ciri;
                if ($ciri) {
                    $ciriCocokDetail[] = $ciri->nama_ciri ?? $kodeCiri;
                }
            }
        }

        $persentase = count($ciriYangDiperlukan) > 0
            ? (count($ciriYangTerpenuhi) / count($ciriYangDiperlukan)) * 100
            : 0;

        return [
            'kode_kecerdasan' => $kodeKecerdasan,
            'total_ciri' => count($ciriYangDiperlukan),
            'ciri_terpenuhi' => count($ciriYangTerpenuhi),
            'persentase' => round($persentase, 2),
            'ciri_cocok' => $ciriCocokDetail,
            'kode_ciri_terpenuhi' => $ciriYangTerpenuhi
        ];
    }

    /**
     * Generate recommendation based on percentage
     *
     * @param float $persentase Percentage score
     * @return string Recommendation
     */
    private function generateRecommendation($persentase)
    {
        if ($persentase >= 80) {
            return 'Sangat Sesuai';
        } elseif ($persentase >= 65) {
            return 'Sesuai';
        } elseif ($persentase >= 50) {
            return 'Cukup Sesuai';
        } else {
            return 'Kurang Sesuai';
        }
    }

    /**
     * Generate suggestions based on analysis
     *
     * @param float $persentase Percentage score
     * @param string $namaJurusan Major name
     * @return array Suggestions
     */
    private function generateSuggestions($persentase, $namaJurusan)
    {
        $saran = [];

        if ($persentase >= 80) {
            $saran[] = "Anda sangat cocok dengan jurusan {$namaJurusan}. Pertimbangkan untuk melanjutkan ke jurusan ini.";
            $saran[] = "Kembangkan minat dan bakat Anda lebih dalam di bidang ini.";
        } elseif ($persentase >= 65) {
            $saran[] = "Anda cukup cocok dengan jurusan {$namaJurusan}. Pelajari lebih lanjut tentang prospek kariernya.";
            $saran[] = "Konsultasikan dengan guru BK atau orang tua untuk pertimbangan lebih lanjut.";
        } elseif ($persentase >= 50) {
            $saran[] = "Jurusan {$namaJurusan} bisa menjadi pilihan alternatif untuk Anda.";
            $saran[] = "Pertimbangkan untuk mencari informasi lebih detail tentang mata kuliah dan prospek kerja.";
        } else {
            $saran[] = "Jurusan {$namaJurusan} mungkin kurang sesuai dengan minat dan bakat Anda saat ini.";
            $saran[] = "Eksplorasi jurusan lain yang lebih sesuai dengan karakteristik Anda.";
        }

        return $saran;
    }

    /**
     * Generate overall analysis for all majors
     *
     * @param array $rekomendasi Recommendations
     * @param array $jawabanSiswa Student answers
     * @return string Overall analysis
     */
    private function generateOverallAnalysis($rekomendasi, $jawabanSiswa)
    {
        $totalJawaban = count($jawabanSiswa);
        $jawabanYa = count(array_filter($jawabanSiswa, fn($jawaban) => $jawaban === 'ya'));
        $totalRekomendasi = count($rekomendasi);

        $analisis = "Berdasarkan {$totalJawaban} pertanyaan yang dijawab, dengan {$jawabanYa} jawaban positif, ";

        if ($totalRekomendasi > 0) {
            $topPersentase = array_values($rekomendasi)[0]['kecerdasan']['persentase'];
            $analisis .= "sistem menemukan {$totalRekomendasi} rekomendasi jurusan yang sesuai. ";
            $analisis .= "Tingkat kesesuaian tertinggi adalah {$topPersentase}%.";
        } else {
            $analisis .= "sistem tidak menemukan rekomendasi jurusan yang memenuhi kriteria minimum.";
        }

        return $analisis;
    }

    /**
     * Generate overall suggestions
     *
     * @param array $rekomendasi Recommendations
     * @return array Suggestions
     */
    private function generateOverallSuggestions($rekomendasi)
    {
        $saran = [];

        if (empty($rekomendasi)) {
            $saran[] = "Coba konsultasi ulang dengan menjawab pertanyaan lebih teliti.";
            $saran[] = "Konsultasikan dengan guru BK di sekolah untuk bimbingan lebih lanjut.";
            $saran[] = "Pertimbangkan untuk mengikuti tes minat bakat yang lebih komprehensif.";
        } else {
            $saran[] = "Pelajari lebih detail tentang jurusan-jurusan yang direkomendasikan.";
            $saran[] = "Cari informasi tentang universitas yang menyediakan jurusan tersebut.";
            $saran[] = "Konsultasikan hasil ini dengan orang tua dan guru BK.";
            $saran[] = "Pertimbangkan prospek karier dari masing-masing jurusan yang direkomendasikan.";
        }

        return $saran;
    }

    /**
     * Format answer details for display
     *
     * @param array $jawabanSiswa Student answers
     * @return array Formatted answer details
     */
    private function formatAnswerDetails($jawabanSiswa)
    {
        $details = [];
        $ciriList = CiriCiri::whereIn('kode_ciri', array_keys($jawabanSiswa))->get()->keyBy('kode_ciri');

        foreach ($jawabanSiswa as $kodeCiri => $jawaban) {
            $namaCiri = $ciriList[$kodeCiri]->nama_ciri ?? $kodeCiri;
            $details[$namaCiri] = ucfirst($jawaban);
        }

        return $details;
    }

    /**
     * Generate error response
     *
     * @param string $message Error message
     * @return array Error response
     */
    private function errorResponse($message)
    {
        return [
            'error' => true,
            'message' => $message,
            'metode' => 'Backward Chaining',
            'timestamp' => now()->toDateTimeString()
        ];
    }

    /**
     * Get detailed analysis for debugging
     *
     * @param array $jawabanSiswa Student answers
     * @return array Detailed analysis
     */
    public function getDetailedAnalysis($jawabanSiswa)
    {
        $allIntelligence = Kecerdasan::all();
        $detailedAnalysis = [];

        foreach ($allIntelligence as $kecerdasan) {
            $analisis = $this->analisisKecerdasan($jawabanSiswa, $kecerdasan->kode_kecerdasan);
            $detailedAnalysis[$kecerdasan->kode_kecerdasan] = [
                'nama_kecerdasan' => $kecerdasan->nama_kecerdasan,
                'analisis' => $analisis
            ];
        }

        return $detailedAnalysis;
    }
}
