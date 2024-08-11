<?php

namespace Database\Seeders;

use App\Models\Satuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanSeeder extends Seeder
{
    public function run(): void
    {
        $satuans = [
            [
                'nama' => 'Kilogram',
                'deskripsi' => 'Satuan berat'
            ],
            [
                'nama' => 'Meter',
                'deskripsi' => 'Satuan panjang'
            ],
            [
                'nama' => 'Liter',
                'deskripsi' => 'Satuan volume'
            ],
            [
                'nama' => 'Unit',
                'deskripsi' => 'Satuan hitungan barang'
            ]
        ];

        foreach ($satuans as $satuan) {
            Satuan::firstOrCreate(
                ['nama' => $satuan['nama']], // Kriteria untuk memeriksa apakah data sudah ada
                ['deskripsi' => $satuan['deskripsi']] // Data yang akan diisi jika tidak ada
            );
        }
    }
}
