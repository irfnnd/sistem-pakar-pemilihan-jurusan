<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            KecerdasanSeeder::class,
            JurusanSeeder::class,
            CiriCiriSeeder::class,
            RulesSeeder::class, // Pastikan ini dipanggil terakhir karena bergantung pada data sebelumnya
        ]);
    }
}
