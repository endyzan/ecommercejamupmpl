<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriJamuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis = [
            ['id_kategori' => 1, 'nama_kategori' => 'Kunyit Asam'],
            ['id_kategori' => 2, 'nama_kategori' => 'Beras Kencur'],
            ['id_kategori' => 3, 'nama_kategori' => 'Temulawak'],
            ['id_kategori' => 4, 'nama_kategori' => 'Jahe Merah'],
            ['id_kategori' => 5, 'nama_kategori' => 'Sinom'],
            ['id_kategori' => 6, 'nama_kategori' => 'Temu Lawak'],
            ['id_kategori' => 7, 'nama_kategori' => 'Pahit'],
            ['id_kategori' => 8, 'nama_kategori' => 'Kencur'],
        ];

        DB::table('kategori')->insert($jenis);
    }
}
