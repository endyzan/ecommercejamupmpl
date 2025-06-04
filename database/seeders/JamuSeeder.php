<?php

namespace Database\Seeders;

use App\Models\Jamu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JamuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        include_once base_path('database/seeders/data/jamu.php');

        foreach ($jamu as $item) {
            $fitur = strtolower($item['manfaat'] . ' ' . $item['deskripsi'] . ' ' . $item['komposisi']);

            // Hapus tanda baca (kecuali spasi)
            $fitur = preg_replace('/[.,]/', '', $fitur);

            // Pecah jadi kata-kata
            $tokens = preg_split('/\s+/', trim($fitur));

            // Hilangkan kata kosong (jika ada)
            $tokens = array_filter($tokens);


            $tokens = implode(',', preg_split('/\s+/', trim($fitur)));
            $item['fitur_index'] = $tokens;

            Jamu::updateOrCreate(
                ['id_jamu' => $item['id_jamu']],
                $item
            );
        }

        // $fitur = strtolower($jamu->manfaat . ' ' . $jamu->deskripsi . ' ' . $jamu->komposisi);
        // $tokens = implode(',', preg_split('/\s+/', trim($fitur)));
        // $jamu->fitur_index = $tokens;
        // $jamu->save();



        // DB::table('jamu')->insert($jamu);
    }
}
