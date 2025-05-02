<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisDokumen;

class JenisDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Peraturan Gubernur', 'jumlah' => 0, 'produk_hukum_id' => 1],
            ['nama' => 'Peraturan Daerah', 'jumlah' => 0, 'produk_hukum_id' => 1],
            ['nama' => 'Naskah Akademik', 'jumlah' => 0, 'produk_hukum_id' => 1],
        ];

        foreach ($data as $item) {
            JenisDokumen::create($item);
        }
    }
}
