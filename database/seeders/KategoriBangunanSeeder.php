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

            ['nama' => 'Jalan', 'deskripsi' => 'Infrastruktur transportasi yang dirancang untuk memungkinkan pergerakan kendaraan dan pejalan kaki dari satu tempat ke tempat lain'],
            ['nama' => 'Jembatan', 'deskripsi' => 'Struktur rekayasa yang dibangun untuk melintasi rintangan seperti sungai, lembah, atau jalan lainnya'],
            ['nama' => 'Tempat Ibadah', 'deskripsi' => 'Bangunan atau lokasi yang digunakan oleh kelompok agama untuk melakukan ritual keagamaan, doa, dan kegiatan spiritual'],
        ];

        foreach ($categories as $category) {
            KategoriBangunan::firstOrCreate($category);
        }
    }
}
