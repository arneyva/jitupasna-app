<?php

namespace Database\Seeders;

use App\Models\Desa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Kecamatan ID 1
            ['kecamatan_id' => 1, 'nama' => 'Banyuanyar', 'kode_pos' => '57137'],
            ['kecamatan_id' => 1, 'nama' => 'Gilingan', 'kode_pos' => '57134'],
            ['kecamatan_id' => 1, 'nama' => 'Kadipiro', 'kode_pos' => '57136'],
            ['kecamatan_id' => 1, 'nama' => 'Keprabon', 'kode_pos' => '57131'],
            ['kecamatan_id' => 1, 'nama' => 'Kestalan', 'kode_pos' => '57133'],
            ['kecamatan_id' => 1, 'nama' => 'Ketelan', 'kode_pos' => '57132'],
            ['kecamatan_id' => 1, 'nama' => 'Manahan', 'kode_pos' => '57139'],
            ['kecamatan_id' => 1, 'nama' => 'Mangkubumen', 'kode_pos' => '57139'],
            ['kecamatan_id' => 1, 'nama' => 'Nusukan', 'kode_pos' => '57135'],
            ['kecamatan_id' => 1, 'nama' => 'Punggawan', 'kode_pos' => '57132'],
            ['kecamatan_id' => 1, 'nama' => 'Setabelan', 'kode_pos' => '57139'],
            ['kecamatan_id' => 1, 'nama' => 'Sumber', 'kode_pos' => '57138'],
            ['kecamatan_id' => 1, 'nama' => 'Timuran', 'kode_pos' => '57131'],

            // Kecamatan ID 2
            ['kecamatan_id' => 2, 'nama' => 'Gandekan', 'kode_pos' => '57122'],
            ['kecamatan_id' => 2, 'nama' => 'Jagalan', 'kode_pos' => '57162'],
            ['kecamatan_id' => 2, 'nama' => 'Jebres', 'kode_pos' => '57126'],
            ['kecamatan_id' => 2, 'nama' => 'Kepatihan Kulon', 'kode_pos' => '57129'],
            ['kecamatan_id' => 2, 'nama' => 'Kepatihan Wetan', 'kode_pos' => '57129'],
            ['kecamatan_id' => 2, 'nama' => 'Mojosongo', 'kode_pos' => '57127'],
            ['kecamatan_id' => 2, 'nama' => 'Pucangsawit', 'kode_pos' => '57125'],
            ['kecamatan_id' => 2, 'nama' => 'Purwodiningratan', 'kode_pos' => '57128'],
            ['kecamatan_id' => 2, 'nama' => 'Sewu', 'kode_pos' => '57129'],
            ['kecamatan_id' => 2, 'nama' => 'Sudiroprajan', 'kode_pos' => '57121'],
            ['kecamatan_id' => 2, 'nama' => 'Tegalharjo', 'kode_pos' => '57128'],

            // Kecamatan ID 3
            ['kecamatan_id' => 3, 'nama' => 'Bumi', 'kode_pos' => '57149'],
            ['kecamatan_id' => 3, 'nama' => 'Jajar', 'kode_pos' => '57144'],
            ['kecamatan_id' => 3, 'nama' => 'Karangasem', 'kode_pos' => '57145'],
            ['kecamatan_id' => 3, 'nama' => 'Kerten', 'kode_pos' => '57143'],
            ['kecamatan_id' => 3, 'nama' => 'Laweyan', 'kode_pos' => '57148'],
            ['kecamatan_id' => 3, 'nama' => 'Pajang', 'kode_pos' => '57146'],
            ['kecamatan_id' => 3, 'nama' => 'Panularan', 'kode_pos' => '57149'],
            ['kecamatan_id' => 3, 'nama' => 'Penumping', 'kode_pos' => '57141'],
            ['kecamatan_id' => 3, 'nama' => 'Purwosari', 'kode_pos' => '57142'],
            ['kecamatan_id' => 3, 'nama' => 'Sondakan', 'kode_pos' => '57147'],
            ['kecamatan_id' => 3, 'nama' => 'Sriwedari', 'kode_pos' => '57141'],

            // Kecamatan ID 4
            ['kecamatan_id' => 4, 'nama' => 'Baluwarti', 'kode_pos' => '57144'],
            ['kecamatan_id' => 4, 'nama' => 'Gajahan', 'kode_pos' => '57155'],
            ['kecamatan_id' => 4, 'nama' => 'Joyosuran', 'kode_pos' => '57116'],
            ['kecamatan_id' => 4, 'nama' => 'Kampung Baru', 'kode_pos' => '57133'],
            ['kecamatan_id' => 4, 'nama' => 'Kauman', 'kode_pos' => '57122'],
            ['kecamatan_id' => 4, 'nama' => 'Kedung Lumbu', 'kode_pos' => '57133'],
            ['kecamatan_id' => 4, 'nama' => 'Pasar Kliwon', 'kode_pos' => '57118'],
            ['kecamatan_id' => 4, 'nama' => 'Sangkrah', 'kode_pos' => '57199'],
            ['kecamatan_id' => 4, 'nama' => 'Semanggi', 'kode_pos' => '57191'],

            // Kecamatan ID 5
            ['kecamatan_id' => 5, 'nama' => 'Danukusuman', 'kode_pos' => '57156'],
            ['kecamatan_id' => 5, 'nama' => 'Jayengan', 'kode_pos' => '57152'],
            ['kecamatan_id' => 5, 'nama' => 'Joyotakan', 'kode_pos' => '57157'],
            ['kecamatan_id' => 5, 'nama' => 'Kemlayan', 'kode_pos' => '57151'],
            ['kecamatan_id' => 5, 'nama' => 'Kratonan', 'kode_pos' => '57153'],
            ['kecamatan_id' => 5, 'nama' => 'Serengan', 'kode_pos' => '57155'],
            ['kecamatan_id' => 5, 'nama' => 'Tipes', 'kode_pos' => '57154'],
        ];

        foreach ($data as $item) {
            Desa::firstOrCreate($item);
        }
    }
}
