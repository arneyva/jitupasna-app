<?php

namespace Database\Seeders;

use App\Models\Satuan;
use Illuminate\Database\Seeder;

class SatuanSeeder extends Seeder
{
    public function run(): void
    {
        $satuans = [
            [
                'nama' => 'Kilogram',
                'deskripsi' => 'Satuan berat',
            ],
            [
                'nama' => 'Meter',
                'deskripsi' => 'Satuan panjang',
            ],
            [
                'nama' => 'Liter',
                'deskripsi' => 'Satuan volume',
            ],
            [
                'nama' => 'Unit',
                'deskripsi' => 'Satuan hitungan barang',
            ],
            [
                'nama' => 'Sack',
                'deskripsi' => 'Satuan pengukuran barang yang biasanya digunakan untuk benda yang dikemas dalam kantong,g',
            ],
            [
                'nama' => 'Kubik',
                'deskripsi' => 'Satuan volume yang digunakan untuk mengukur kapasitas ruang tiga dimensi',
            ],
            [
                'nama' => 'OH',
                'deskripsi' => 'Satuan waktu yang digunakan untuk mengukur durasi operasional atau jam kerja suatu mesin, sistem, atau fasilitas',
            ],
            [
                'nama' => 'Jam',
                'deskripsi' => 'Satuan waktu yang setara dengan 60 menit atau 3.600 detik',
            ],

        ];

        foreach ($satuans as $satuan) {
            Satuan::firstOrCreate(
                ['nama' => $satuan['nama']], // Kriteria untuk memeriksa apakah data sudah ada
                ['deskripsi' => $satuan['deskripsi']] // Data yang akan diisi jika tidak ada
            );
        }
    }
}
