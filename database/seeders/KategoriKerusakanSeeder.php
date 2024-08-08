<?php

namespace Database\Seeders;

use App\Models\KategoriKerusakan;
use Illuminate\Database\Seeder;

class KategoriKerusakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriKerusakan::firstOrCreate([
            'nama' => 'Ringan',
            'level' => 1,
            'deskripsi' => 'Kategori Ringan',
        ]);
        KategoriKerusakan::firstOrCreate([
            'nama' => 'Sedang',
            'level' => 2,
            'deskripsi' => 'Kategori Sedang',
        ]);
        KategoriKerusakan::firstOrCreate([
            'nama' => 'Berat',
            'level' => 3,
            'deskripsi' => 'Kategori Berat',
        ]);
    }
}
