<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kecerdasan;

class KecerdasanSeeder extends Seeder
{
    public function run()
    {
        $kecerdasan = [
            ['kode' => 'K001', 'nama_kecerdasan' => 'Kecerdasan Linguistic-Verbal'],
            ['kode' => 'K002', 'nama_kecerdasan' => 'Kecerdasan Logika-Matematika'],
            ['kode' => 'K003', 'nama_kecerdasan' => 'Kecerdasan Spasial-Visual'],
            ['kode' => 'K004', 'nama_kecerdasan' => 'Kecerdasan Ritmik-Musik'],
            ['kode' => 'K005', 'nama_kecerdasan' => 'Kecerdasan Kinestetik'],
            ['kode' => 'K006', 'nama_kecerdasan' => 'Kecerdasan Interpersonal'],
            ['kode' => 'K007', 'nama_kecerdasan' => 'Kecerdasan Intrapersonal'],
            ['kode' => 'K008', 'nama_kecerdasan' => 'Kecerdasan Naturalis'],
            ['kode' => 'K009', 'nama_kecerdasan' => 'Kecerdasan Eksistensial'],
        ];

        foreach ($kecerdasan as $item) {
            Kecerdasan::create($item);
        }
    }
}
