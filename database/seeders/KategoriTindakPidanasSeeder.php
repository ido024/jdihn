<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriTindakPidanasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_tindak_pidanas')->insert([
            [
                'no_kategori_pidana' => 'Pasal 362 KUHP',
                'nama_kategori' => 'Pencurian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kategori_pidana' => 'Pasal 285 KUHP',
                'nama_kategori' => 'Pemerkosaan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kategori_pidana' => 'Pasal 338 KUHP',
                'nama_kategori' => 'Pembunuhan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kategori_pidana' => 'Pasal 351 KUHP',
                'nama_kategori' => 'Penganiayaan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kategori_pidana' => 'Pasal 378 KUHP',
                'nama_kategori' => 'Penipuan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kategori_pidana' => 'Pasal 263 KUHP',
                'nama_kategori' => 'Pemalsuan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_kategori_pidana' => 'Pasal 365 KUHP',
                'nama_kategori' => 'Perampokan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
