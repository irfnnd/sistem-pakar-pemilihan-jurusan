<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run()
    {
        $jurusan = [
            // K001 - Linguistic-Verbal
            ['nama_jurusan' => 'Ilmu Perpustakaan', 'kode_kecerdasan' => 'K001'],
            ['nama_jurusan' => 'Ilmu Komunikasi', 'kode_kecerdasan' => 'K001'],
            ['nama_jurusan' => 'Bahasa dan Sastra', 'kode_kecerdasan' => 'K001'],
            ['nama_jurusan' => 'Ilmu Hubungan Internasional', 'kode_kecerdasan' => 'K001'],
            ['nama_jurusan' => 'Ilmu Hukum', 'kode_kecerdasan' => 'K001'],
            ['nama_jurusan' => 'Ilmu Politik', 'kode_kecerdasan' => 'K001'],

            // K002 - Logika-Matematika
            ['nama_jurusan' => 'Statistika', 'kode_kecerdasan' => 'K002'],
            ['nama_jurusan' => 'Administrasi Negara', 'kode_kecerdasan' => 'K002'],
            ['nama_jurusan' => 'Akuntansi', 'kode_kecerdasan' => 'K002'],
            ['nama_jurusan' => 'Ilmu Ekonomi', 'kode_kecerdasan' => 'K002'],
            ['nama_jurusan' => 'Pendidikan Matematika', 'kode_kecerdasan' => 'K002'],
            ['nama_jurusan' => 'Ilmu Fisika', 'kode_kecerdasan' => 'K002'],
            ['nama_jurusan' => 'Ilmu Kimia', 'kode_kecerdasan' => 'K002'],
            ['nama_jurusan' => 'Teknik Informatika', 'kode_kecerdasan' => 'K002'],
            ['nama_jurusan' => 'Sistem Informasi', 'kode_kecerdasan' => 'K002'],

            // K003 - Spasial-Visual
            ['nama_jurusan' => 'Seni Rupa', 'kode_kecerdasan' => 'K003'],
            ['nama_jurusan' => 'Teknik Arsitektur', 'kode_kecerdasan' => 'K003'],
            ['nama_jurusan' => 'Planologi', 'kode_kecerdasan' => 'K003'],
            ['nama_jurusan' => 'Teknik Sipil', 'kode_kecerdasan' => 'K003'],

            // K004 - Ritmik-Musik
            ['nama_jurusan' => 'Seni Musik', 'kode_kecerdasan' => 'K004'],

            // K005 - Kinestetik
            ['nama_jurusan' => 'Kedokteran Gigi', 'kode_kecerdasan' => 'K005'],
            ['nama_jurusan' => 'Kebidanan', 'kode_kecerdasan' => 'K005'],
            ['nama_jurusan' => 'Seni Tari', 'kode_kecerdasan' => 'K005'],
            ['nama_jurusan' => 'PJKR', 'kode_kecerdasan' => 'K005'],
            ['nama_jurusan' => 'Teknik Mesin', 'kode_kecerdasan' => 'K005'],

            // K006 - Interpersonal
            ['nama_jurusan' => 'Ilmu Sosiologi', 'kode_kecerdasan' => 'K006'],
            ['nama_jurusan' => 'PGPAUD', 'kode_kecerdasan' => 'K006'],
            ['nama_jurusan' => 'PGSD', 'kode_kecerdasan' => 'K006'],
            ['nama_jurusan' => 'Psikologi', 'kode_kecerdasan' => 'K006'],
            ['nama_jurusan' => 'Kedokteran', 'kode_kecerdasan' => 'K006'],
            ['nama_jurusan' => 'Ilmu Keperawatan', 'kode_kecerdasan' => 'K006'],
            ['nama_jurusan' => 'Fakultas Kesehatan Masyarakat', 'kode_kecerdasan' => 'K006'],
            ['nama_jurusan' => 'Antropologi', 'kode_kecerdasan' => 'K006'],

            // K007 - Intrapersonal
            ['nama_jurusan' => 'Ilmu Agama', 'kode_kecerdasan' => 'K007'],
            ['nama_jurusan' => 'Administrasi Niaga', 'kode_kecerdasan' => 'K007'],

            // K008 - Naturalis
            ['nama_jurusan' => 'Kedokteran Hewan', 'kode_kecerdasan' => 'K008'],
            ['nama_jurusan' => 'Fakultas Perikanan', 'kode_kecerdasan' => 'K008'],
            ['nama_jurusan' => 'Fakultas Peternakan', 'kode_kecerdasan' => 'K008'],
            ['nama_jurusan' => 'Ilmu Biologi', 'kode_kecerdasan' => 'K008'],
            ['nama_jurusan' => 'Fakultas Pertanian', 'kode_kecerdasan' => 'K008'],

            // K009 - Eksistensial
            ['nama_jurusan' => 'Ilmu Filsafat', 'kode_kecerdasan' => 'K009'],
            ['nama_jurusan' => 'Ilmu Sejarah', 'kode_kecerdasan' => 'K009'],
        ];

        foreach ($jurusan as $item) {
            Jurusan::create($item);
        }
    }
}
