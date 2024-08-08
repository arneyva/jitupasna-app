<?php

namespace Database\Seeders;

use App\Models\KategoriBangunan;
use Illuminate\Database\Seeder;

class KategoriBangunanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['nama' => 'Rumah', 'deskripsi' => 'Tempat tinggal bagi individu atau keluarga'],
            ['nama' => 'Apartemen', 'deskripsi' => 'Tempat tinggal bertingkat dengan unit-unit individual'],
            ['nama' => 'Kantor', 'deskripsi' => 'Bangunan yang digunakan untuk kegiatan perkantoran'],
            ['nama' => 'Ruko', 'deskripsi' => 'Bangunan yang menggabungkan fungsi rumah dan toko'],
            ['nama' => 'Gudang', 'deskripsi' => 'Bangunan yang digunakan untuk penyimpanan barang'],
        ];

        foreach ($categories as $category) {
            KategoriBangunan::firstOrCreate($category);
        }
    }
}
