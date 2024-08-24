<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Banjarsari'],
            ['nama' => 'Jebres'],
            ['nama' => 'Laweyan'],
            ['nama' => 'Pasar Kliwon'],
            ['nama' => 'Serengan'],
        ];

        foreach ($data as $item) {
            Kecamatan::firstOrCreate($item);
        }
    }
}
