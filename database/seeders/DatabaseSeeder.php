<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(KategoriKerusakanSeeder::class);
        $this->call(KategoriBencanaSeeder::class);
        $this->call(KategoriBangunanSeeder::class);
        $this->call(SatuanSeeder::class);
        //
        $this->call(HSDSeeder::class);
        $this->call(KecamatanSeeder::class);
        $this->call(DesaSeeder::class);

    }
}
