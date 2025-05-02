<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProdukHukum;

class ProdukHukumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
       
            ['nama' => 'Peraturan Daerah', 'jumlah' => 0],
          
        ];

        foreach ($data as $item) {
            ProdukHukum::create($item);
        }
    }
}
