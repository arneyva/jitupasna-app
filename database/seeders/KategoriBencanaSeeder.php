<?php

namespace Database\Seeders;

use App\Models\KategoriBencana;
use Illuminate\Database\Seeder;

class KategoriBencanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriBencana::firstOrCreate([
            'nama' => 'Gempa Bumi',
            'deskripsi' => 'Bencana alam berupa getaran atau guncangan yang terjadi karena pergeseran lapisan bumi.',
        ]);
        KategoriBencana::firstOrCreate([
            'nama' => 'Banjir',
            'deskripsi' => 'Kejadian di mana air menutupi area yang biasanya kering, seperti akibat hujan deras atau meluapnya sungai.',
        ]);
        KategoriBencana::firstOrCreate([
            'nama' => 'Banjir Bandaang',
            'deskripsi' => 'Jenis banjir yang terjadi secara mendadak dan ekstrem, biasanya disebabkan oleh hujan deras dalam waktu singkat, terutama di daerah pegunungan atau lereng bukit',
        ]);
        KategoriBencana::firstOrCreate([
            'nama' => 'Tsunami',
            'deskripsi' => 'Gelombang besar yang terjadi akibat gempa bumi atau letusan gunung berapi di dasar laut.',
        ]);

        KategoriBencana::firstOrCreate([
            'nama' => 'Erupsi Gunung Berapi',
            'deskripsi' => 'Bencana alam yang terjadi akibat letusan dari gunung berapi yang mengeluarkan lava dan abu vulkanik.',
        ]);

        KategoriBencana::firstOrCreate([
            'nama' => 'Kekeringan',
            'deskripsi' => 'Kondisi di mana suatu daerah mengalami kekurangan air yang parah dalam jangka waktu yang panjang.',
        ]);

        KategoriBencana::firstOrCreate([
            'nama' => 'Tanah Longsor',
            'deskripsi' => 'Peristiwa alam di mana tanah dan batuan bergerak turun dari lereng bukit atau gunung.',
        ]);

        KategoriBencana::firstOrCreate([
            'nama' => 'Puting Beliung',
            'deskripsi' => 'Kondisi cuaca ekstrim yang melibatkan angin kencang, hujan deras, dan petir.',
        ]);
        KategoriBencana::firstOrCreate([
            'nama' => 'Kebakaran',
            'deskripsi' => 'Kebakaran adalah kejadian di mana api menyebar dan membakar material yang mudah terbakar seperti kayu, tanaman, atau bangunan.',
        ]);
        KategoriBencana::firstOrCreate([
            'nama' => 'Kebakaran Hutan',
            'deskripsi' => 'Bencana alam yang melibatkan api besar yang menyebar dengan cepat dan tidak terkendali di daerah hutan.',
        ]);
    }
}
