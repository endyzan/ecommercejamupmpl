<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriJamuSeeder extends Seeder
{
    public function run()
    {
        $jenis = [
            ['id_jenis' => 1, 'nama_jenis' => 'Kunyit Asam'],
            ['id_jenis' => 2, 'nama_jenis' => 'Beras Kencur'],
            ['id_jenis' => 3, 'nama_jenis' => 'Temulawak'],
            ['id_jenis' => 4, 'nama_jenis' => 'Jahe Merah'],
            ['id_jenis' => 5, 'nama_jenis' => 'Sinom'],
            ['id_jenis' => 6, 'nama_jenis' => 'Temu Lawak'],
            ['id_jenis' => 7, 'nama_jenis' => 'Pahit'],
            ['id_jenis' => 8, 'nama_jenis' => 'Kencur'],
        ];

        DB::table('kategori')->insert($jenis);
    }
}
