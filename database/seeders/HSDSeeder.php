<?php

namespace Database\Seeders;

use App\Models\HSD;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HSDSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            ['tipe' => 1, 'nama' => 'Aditif Beton', 'satuan' => 'kg', 'harga' => 55900],
            ['tipe' => 1, 'nama' => 'Agr. Base Kelas A', 'satuan' => 'm3', 'harga' => 265000],
            ['tipe' => 1, 'nama' => 'Agr. Base Kelas B', 'satuan' => 'm3', 'harga' => 250000],
            ['tipe' => 1, 'nama' => 'Agr. Base Kelas S', 'satuan' => 'm3', 'harga' => 212000],
            ['tipe' => 1, 'nama' => 'Agregat Pecah Mesin 0-5 mm', 'satuan' => 'm3', 'harga' => 285000],
            ['tipe' => 1, 'nama' => 'Agregat Pecah Mesin 10-20 mm', 'satuan' => 'm3', 'harga' => 233000],
            ['tipe' => 1, 'nama' => 'Agregat Pecah Mesin 20-30 mm', 'satuan' => 'm3', 'harga' => 220000],
            ['tipe' => 1, 'nama' => 'Agregat Pecah Mesin 5-10 mm', 'satuan' => 'm3', 'harga' => 267000],
            ['tipe' => 1, 'nama' => 'Anchorage', 'satuan' => 'buah', 'harga' => 579000],
            ['tipe' => 1, 'nama' => 'Anti Stripping Agent', 'satuan' => 'liter', 'harga' => 76000],
            // 
            ['tipe' => 2, 'nama' => 'Mandor', 'satuan' => 'per jam', 'harga' => 17313.49],
            ['tipe' => 2, 'nama' => 'Mekanik', 'satuan' => 'per jam', 'harga' => 17390.77],
            ['tipe' => 2, 'nama' => 'Operator', 'satuan' => 'per jam', 'harga' => 17390.77],
            ['tipe' => 2, 'nama' => 'Pekerja', 'satuan' => 'per jam', 'harga' => 12423.82],
            ['tipe' => 2, 'nama' => 'Pembantu Mekanik', 'satuan' => 'per jam', 'harga' => 14852.10],
            ['tipe' => 2, 'nama' => 'Pembantu Operator', 'satuan' => 'per jam', 'harga' => 14852.10],
            ['tipe' => 2, 'nama' => 'Pembantu Sopir / Driver', 'satuan' => 'per jam', 'harga' => 13767.57],
            ['tipe' => 2, 'nama' => 'Sopir / Driver', 'satuan' => 'per jam', 'harga' => 16374.74],
            ['tipe' => 2, 'nama' => 'Tukang', 'satuan' => 'per jam', 'harga' => 15388.70],
            // 
            ['tipe' => 3, 'nama' => 'Agregat (chip) Spreader (1000 L)', 'satuan' => 'unit', 'harga' => 116596000],
            ['tipe' => 3, 'nama' => 'Alat Penghapus Marka Jalan', 'satuan' => 'unit', 'harga' => 28000000],
            ['tipe' => 3, 'nama' => 'Asphalt Cutter', 'satuan' => 'unit', 'harga' => 21540000],
            ['tipe' => 3, 'nama' => 'Asphalt Distribution (4000 L)', 'satuan' => 'unit', 'harga' => 185000000],
            ['tipe' => 3, 'nama' => 'Asphalt Finisher', 'satuan' => 'unit', 'harga' => 5156464500],
            ['tipe' => 3, 'nama' => 'Asphalt Liquid Mixer', 'satuan' => 'unit', 'harga' => 5331616500],
            ['tipe' => 3, 'nama' => 'Asphalt Mixing Plant (AMP)', 'satuan' => 'unit', 'harga' => 7949726400],
            ['tipe' => 3, 'nama' => 'Asphalt Sprayer (1000 L)', 'satuan' => 'unit', 'harga' => 125000000],
            ['tipe' => 3, 'nama' => 'Asphalt Tanker', 'satuan' => 'unit', 'harga' => 47698900],
            ['tipe' => 3, 'nama' => 'Bar Bender', 'satuan' => 'unit', 'harga' => 22260000],
        ];

        foreach ($data as $item) {
            HSD::firstOrCreate($item);
        }
    }
}
