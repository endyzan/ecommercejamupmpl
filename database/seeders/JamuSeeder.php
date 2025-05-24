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
        // Data Jamu
        $jamu = [
            [
                'id_jamu'     => 1,
                'nama_jamu'   => 'Jamu Kunyit Asam',
                'harga'       => 15000,
                'komposisi'   => 'Kunyit, Asam Jawa, Gula Merah',
                'deskripsi'   => 'Tonik tradisional untuk meningkatkan daya tahan tubuh dan meredakan nyeri haid.',
                'gambar'      => 'Jamu_Kunyit_Asam.jpeg',
                'aturan_pakai' => '2 kali sehari, pagi & sore.',
                'berat'       => 200,
                'stok'        => 50,
                'manfaat'     => 'Anti-inflamasi, antioksidan, pelancar haid.',
                'id_kategori' => json_encode([1, 3, 5, 6]),
            ],
            [
                'id_jamu'     => 2,
                'nama_jamu'   => 'Jamu Beras Kencur',
                'harga'       => 12000,
                'komposisi'   => 'Beras, Kencur, Asam Jawa, Daun Pandan, Gula Jawa',
                'deskripsi'   => 'Minuman manis beraroma herbal yang menyehatkan pencernaan dan meredakan batuk.',
                'gambar'      => 'Jamu_Beras_Kencur.jpeg',
                'aturan_pakai' => '1–2 kali sehari.',
                'berat'       => 250,
                'stok'        => 40,
                'manfaat'     => 'Meredakan diare, batuk berdahak, meningkatkan nafsu makan.',
                'id_kategori' => json_encode([2, 4]),
            ],
            [
                'id_jamu'     => 3,
                'nama_jamu'   => 'Jamu Jahe Merah',
                'harga'       => 13000,
                'komposisi'   => 'Jahe Merah, Gula Merah, Air',
                'deskripsi'   => 'Racikan hangat untuk meredakan mual, batuk, dan meningkatkan stamina.',
                'gambar'      => 'Jamu_Jahe_Merah.jpeg',
                'aturan_pakai' => '1 kali sehari, pagi atau malam.',
                'berat'       => 200,
                'stok'        => 60,
                'manfaat'     => 'Antiseptik, pereda mual, penghangat tubuh.',
                'id_kategori' => json_encode([1, 3, 4]),
            ],
            [
                'id_jamu'     => 4,
                'nama_jamu'   => 'Jamu Temulawak',
                'harga'       => 14000,
                'komposisi'   => 'Temulawak, Gula Jawa, Air',
                'deskripsi'   => 'Membantu fungsi hati dan pencernaan, serta sebagai antioksidan.',
                'gambar'      => 'Jamu_Temulawak.jpeg',
                'aturan_pakai' => '1 kali sehari.',
                'berat'       => 200,
                'stok'        => 30,
                'manfaat'     => 'Hepatoprotektor, antioksidan, pelancar pencernaan.',
                'id_kategori' => json_encode([2, 8]),
            ],
            [
                'id_jamu'     => 5,
                'nama_jamu'   => 'Jamu Sinom',
                'harga'       => 10000,
                'komposisi'   => 'Daun Asam Muda (Sinom), Gula Merah, Air',
                'deskripsi'   => 'Dikenal menyegarkan dan membantu detoksifikasi tubuh.',
                'gambar'      => 'Jamu_Sinom.jpeg',
                'aturan_pakai' => '1 kali sehari.',
                'berat'       => 200,
                'stok'        => 45,
                'manfaat'     => 'Detoksifikasi, antioksidan.',
                'id_kategori' => json_encode([8]),
            ],
            [
                'id_jamu'     => 6,
                'nama_jamu'   => 'Jamu Brotowali',
                'harga'       => 16000,
                'komposisi'   => 'Brotowali, Madu, Air',
                'deskripsi'   => 'Tradisional untuk mengatasi demam dan gangguan pencernaan.',
                'gambar'      => 'Jamu_Brotowali.jpeg',
                'aturan_pakai' => '1 kali sehari.',
                'berat'       => 150,
                'stok'        => 25,
                'manfaat'     => 'Antipiretik, antidiabetes.',
                'id_kategori' => json_encode([2, 3]),
            ],
            [
                'id_jamu'     => 7,
                'nama_jamu'   => 'Jamu Pegagan',
                'harga'       => 17000,
                'komposisi'   => 'Pegagan, Gula Jawa, Air',
                'deskripsi'   => 'Meningkatkan fungsi otak dan peredaran darah.',
                'gambar'      => 'Jamu_Pegagan.jpeg',
                'aturan_pakai' => '1 kali sehari.',
                'berat'       => 200,
                'stok'        => 35,
                'manfaat'     => 'Nootropik, sirkulasi darah.',
                'id_kategori' => json_encode([4]),
            ],
            [
                'id_jamu'     => 8,
                'nama_jamu'   => 'Jamu Meniran',
                'harga'       => 12000,
                'komposisi'   => 'Meniran, Gula Merah, Air',
                'deskripsi'   => 'Memiliki efek diuretik dan imunomodulator.',
                'gambar'      => 'Jamu_Meniran.jpeg',
                'aturan_pakai' => '1–2 kali sehari.',
                'berat'       => 200,
                'stok'        => 40,
                'manfaat'     => 'Diuretik, imunomodulator.',
                'id_kategori' => json_encode([1]),
            ],
            [
                'id_jamu'     => 9,
                'nama_jamu'   => 'Jamu Sirih',
                'harga'       => 11000,
                'komposisi'   => 'Daun Sirih, Air, Sejumput Garam, Madu',
                'deskripsi'   => 'Antiseptik lokal untuk kesehatan mulut dan kewanitaan.',
                'gambar'      => 'Jamu_Sirih.jpeg',
                'aturan_pakai' => 'Bilas atau diminum sesuai dosis.',
                'berat'       => 100,
                'stok'        => 30,
                'manfaat'     => 'Antiseptik, antijamur.',
                'id_kategori' => json_encode([1, 3]),
            ],
            [
                'id_jamu'     => 10,
                'nama_jamu'   => 'Jamu Cabe Puyang',
                'harga'       => 18000,
                'komposisi'   => 'Cabe Puyang, Gula Jawa, Air',
                'deskripsi'   => 'Untuk meningkatkan vitalitas dan stamina pria.',
                'gambar'      => 'Jamu_Cabe_Puyang.jpeg',
                'aturan_pakai' => '1 kali sehari.',
                'berat'       => 150,
                'stok'        => 20,
                'manfaat'     => 'Afrodisiak, penambah stamina.',
                'id_kategori' => json_encode([4]),
            ],
            [
                'id_jamu'     => 11,
                'nama_jamu'   => 'Jamu Kumis Kucing',
                'harga'       => 13000,
                'komposisi'   => 'Daun Kumis Kucing, Air',
                'deskripsi'   => 'Menunjang kesehatan ginjal dan saluran kemih.',
                'gambar'      => 'Jamu_Kumis_Kucing.jpeg',
                'aturan_pakai' => '1 kali sehari.',
                'berat'       => 200,
                'stok'        => 25,
                'manfaat'     => 'Diuretik, peluruh air seni.',
                'id_kategori' => json_encode([2]),
            ],
            [
                'id_jamu'     => 12,
                'nama_jamu'   => 'Jamu Galian Singset',
                'harga'       => 20000,
                'komposisi'   => 'Kunyit, Kencur, Temulawak, Daun Sirih',
                'deskripsi'   => 'Racikan untuk membantu penurunan berat badan.',
                'gambar'      => 'Jamu_Galian_Singset.jpeg',
                'aturan_pakai' => '1 kali sehari sebelum makan.',
                'berat'       => 200,
                'stok'        => 15,
                'manfaat'     => 'Menurunkan berat badan, meningkatkan metabolisme.',
                'id_kategori' => json_encode([7]),
            ],
            [
                'id_jamu'     => 13,
                'nama_jamu'   => 'Jamu Kunci Suruh',
                'harga'       => 15000,
                'komposisi'   => 'Daun Kunci Suruh, Air',
                'deskripsi'   => 'Tradisional untuk menurunkan darah tinggi dan diabetes.',
                'gambar'      => 'Jamu_Kunci_Suruh.jpeg',
                'aturan_pakai' => '2 kali sehari.',
                'berat'       => 200,
                'stok'        => 20,
                'manfaat'     => 'Antidiabetik, penurun tekanan darah.',
                'id_kategori' => json_encode([1]),
            ],
            [
                'id_jamu'     => 14,
                'nama_jamu'   => 'Jamu Uyup-Uyup',
                'harga'       => 14000,
                'komposisi'   => 'Daun Uyup-Uyup, Gula Jawa, Air',
                'deskripsi'   => 'Mengatasi kelelahan dan nyeri otot.',
                'gambar'      => 'Jamu_Uyup_Uyup.jpeg',
                'aturan_pakai' => '1 kali sehari.',
                'berat'       => 200,
                'stok'        => 30,
                'manfaat'     => 'Relaksan otot, pereda nyeri.',
                'id_kategori' => json_encode([3]),
            ],
            [
                'id_jamu'     => 15,
                'nama_jamu'   => 'Jamu Kencur Sari',
                'harga'       => 13000,
                'komposisi'   => 'Kencur, Gula Jawa, Air',
                'deskripsi'   => 'Menghangatkan badan dan melancarkan pernapasan.',
                'gambar'      => 'Jamu_Kencur_Sari.jpeg',
                'aturan_pakai' => '1 kali sehari.',
                'berat'       => 200,
                'stok'        => 45,
                'manfaat'     => 'Anti-inflamasi, ekspektoran.',
                'id_kategori' => json_encode([1, 4]),
            ],
            [
                'id_jamu'     => 16,
                'nama_jamu'   => 'Jamu Daun Dewa',
                'harga'       => 12000,
                'komposisi'   => 'Daun Dewa, Gula Jawa, Air',
                'deskripsi'   => 'Mengatasi masalah lambung dan membantu penyembuhan luka.',
                'gambar'      => 'Jamu_Daun_Dewa.jpeg',
                'aturan_pakai' => '2 kali sehari.',
                'berat'       => 200,
                'stok'        => 40,
                'manfaat'     => 'Antiinflamasi, penyembuh luka.',
                'id_kategori' => json_encode([2, 3]),
            ],
            [
                'id_jamu'     => 17,
                'nama_jamu'   => 'Jamu Kayu Manis',
                'harga'       => 14000,
                'komposisi'   => 'Kayu Manis, Gula Jawa, Air',
                'deskripsi'   => 'Mengatur kadar gula darah dan meningkatkan sirkulasi darah.',
                'gambar'      => 'Jamu_Kayu_Manis.jpeg',
                'aturan_pakai' => '1 kali sehari.',
                'berat'       => 200,
                'stok'        => 30,
                'manfaat'     => 'Antidiabetik, pelancar darah.',
                'id_kategori' => json_encode([1, 3]),
            ],
            [
                'id_jamu'     => 18,
                'nama_jamu'   => 'Jamu Meniran Madu',
                'harga'       => 16000,
                'komposisi'   => 'Meniran, Madu, Air',
                'deskripsi'   => 'Meningkatkan kekebalan dan memperbaiki stamina.',
                'gambar'      => 'Jamu_Meniran_Madu.jpeg',
                'aturan_pakai' => '1 kali sehari.',
                'berat'       => 200,
                'stok'        => 20,
                'manfaat'     => 'Imunomodulator, peningkat stamina.',
                'id_kategori' => json_encode([1, 4]),
            ],
            [
                'id_jamu'     => 19,
                'nama_jamu'   => 'Jamu Akar Serapat',
                'harga'       => 15000,
                'komposisi'   => 'Akar Serapat, Gula Jawa, Air',
                'deskripsi'   => 'Mengatasi nyeri dan radang sendi.',
                'gambar'      => 'Jamu_Akar_Serapat.jpeg',
                'aturan_pakai' => '2 kali sehari.',
                'berat'       => 150,
                'stok'        => 25,
                'manfaat'     => 'Antiinflamasi, analgesik.',
                'id_kategori' => json_encode([5]),
            ],
            [
                'id_jamu'     => 20,
                'nama_jamu'   => 'Jamu Asem Wer',
                'harga'       => 13000,
                'komposisi'   => 'Asem, Gula Jawa, Air',
                'deskripsi'   => 'Menyejukkan dan menyegarkan tubuh.',
                'gambar'      => 'Jamu_Asem_wer.jpeg',
                'aturan_pakai' => '1 kali sehari.',
                'berat'       => 200,
                'stok'        => 30,
                'manfaat'     => 'Detoksifikasi, menurunkan panas dalam.',
                'id_kategori' => json_encode([8]),
            ],
        ];

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
