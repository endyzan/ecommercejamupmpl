<?php

namespace Database\Seeders;

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
        $jamu = [
            [
                'id_jamu'     => 1,
                'nama_jamu'   => 'Jamu Kunyit Asam Tradisional',
                'harga'       => 15000,
                'komposisi'   => 'Kunyit, Asam Jawa, Gula Merah',
                'deskripsi'   => 'Meningkatkan daya tahan tubuh, membantu meredakan nyeri haid.',
                'gambar'      => 'images/jamu_kunyit_asam.jpg',
                'aturan_pakai' => '2 kali sehari, pagi & sore.',
                'berat'       => 200,
                'stok'        => 50,
                'manfaat'     => 'Anti-inflamasi, detoksifikasi.',
                'id_kategori' => json_encode([1, 5]),
            ],
            [
                'id_jamu'     => 2,
                'nama_jamu'   => 'Jamu Beras Kencur Fresh',
                'harga'       => 12000,
                'komposisi'   => 'Beras Kencur, Gula Aren, Daun Pandan',
                'deskripsi'   => 'Meredakan masuk angin, menambah nafsu makan.',
                'gambar'      => 'images/jamu_beras_kencur.jpg',
                'aturan_pakai' => '1–2 kali sehari setelah makan.',
                'berat'       => 180,
                'stok'        => 40,
                'manfaat'     => 'Meningkatkan pencernaan, pereda pegal.',
                'id_kategori' => json_encode([2, 8]),
            ],
            [
                'id_jamu'     => 3,
                'nama_jamu'   => 'Jamu Temulawak Sehat',
                'harga'       => 13000,
                'komposisi'   => 'Temulawak, Kunyit, Jahe',
                'deskripsi'   => 'Mendukung fungsi hati dan pencernaan.',
                'gambar'      => 'images/jamu_temulawak.jpg',
                'aturan_pakai' => '1 kali sehari.',
                'berat'       => 200,
                'stok'        => 45,
                'manfaat'     => 'Hepatoprotektor, antioksidan.',
                'id_kategori' => json_encode([3, 6]),
            ],
            [
                'id_jamu'     => 4,
                'nama_jamu'   => 'Jamu Jahe Merah Panas',
                'harga'       => 14000,
                'komposisi'   => 'Jahe Merah, Gula Aren',
                'deskripsi'   => 'Menghangatkan tubuh, meredakan mual.',
                'gambar'      => 'images/jamu_jahe_merah.jpg',
                'aturan_pakai' => 'Diminum hangat 2 kali sehari.',
                'berat'       => 150,
                'stok'        => 60,
                'manfaat'     => 'Anti masuk angin, pereda nyeri otot.',
                'id_kategori' => json_encode([4]),
            ],
            [
                'id_jamu'     => 5,
                'nama_jamu'   => 'Jamu Sinom Dingin',
                'harga'       => 11000,
                'komposisi'   => 'Daun Sinom, Asam Jawa, Gula Merah',
                'deskripsi'   => 'Menyegarkan, membantu pencernaan.',
                'gambar'      => 'images/jamu_sinom.jpg',
                'aturan_pakai' => 'Diminum dingin sekali sehari.',
                'berat'       => 180,
                'stok'        => 30,
                'manfaat'     => 'Menurunkan demam, melancarkan BAB.',
                'id_kategori' => json_encode([5]),
            ],
            [
                'id_jamu'     => 6,
                'nama_jamu'   => 'Jamu Pahit Tradisional',
                'harga'       => 10000,
                'komposisi'   => 'Mahkota Dewa, Pegagan, Brotowali',
                'deskripsi'   => 'Detoksifikasi tubuh, meningkatkan imun.',
                'gambar'      => 'images/jamu_pahit.jpg',
                'aturan_pakai' => '1 kali sehari sebelum makan.',
                'berat'       => 150,
                'stok'        => 35,
                'manfaat'     => 'Detoks hati, antiradang.',
                'id_kategori' => json_encode([7]),
            ],
            [
                'id_jamu'     => 7,
                'nama_jamu'   => 'Jamu Kencur Spesial',
                'harga'       => 12500,
                'komposisi'   => 'Kencur, Gula Aren, Daun Kunyit',
                'deskripsi'   => 'Meredakan pegal dan masuk angin.',
                'gambar'      => 'images/jamu_kencur.jpg',
                'aturan_pakai' => '2 kali sehari setelah makan.',
                'berat'       => 170,
                'stok'        => 55,
                'manfaat'     => 'Pereda nyeri, meningkatkan nafsu makan.',
                'id_kategori' => json_encode([8]),
            ],
            ['id_jamu' => 8, 'nama_jamu' => 'Jamu Sambiloto Fit', 'harga' => 16000, 'komposisi' => 'Sambiloto, Madu', 'deskripsi' => 'Meningkatkan daya tahan tubuh.', 'gambar' => 'images/jamu_sambiloto.jpg', 'aturan_pakai' => '1 kali sehari.', 'berat' => 150, 'stok' => 25, 'manfaat' => 'Antivirus, imun booster.', 'id_kategori' => json_encode([7])],
            ['id_jamu' => 9, 'nama_jamu' => 'Jamu Daun Sirih', 'harga' => 9000, 'komposisi' => 'Daun Sirih, Air', 'deskripsi' => 'Tradisional untuk kesehatan wanita.', 'gambar' => 'images/jamu_sirih.jpg', 'aturan_pakai' => '2 kali seminggu.', 'berat' => 100, 'stok' => 20, 'manfaat' => 'Antiseptik, kebersihan area kewanitaan.', 'id_kategori' => json_encode([7])],
            ['id_jamu' => 10, 'nama_jamu' => 'Jamu Pegagan Sehat', 'harga' => 14000, 'komposisi' => 'Daun Pegagan, Madu', 'deskripsi' => 'Meningkatkan kecerdasan dan memori.', 'gambar' => 'images/jamu_pegagan.jpg', 'aturan_pakai' => '1 kali sehari.', 'berat' => 160, 'stok' => 30, 'manfaat' => 'Neuroprotektor, antioksidan.', 'id_kategori' => json_encode([7])],
            ['id_jamu' => 11, 'nama_jamu' => 'Jamu Lidah Buaya', 'harga' => 13000, 'komposisi' => 'Lidah Buaya, Madu', 'deskripsi' => 'Melancarkan pencernaan dan detoks.', 'gambar' => 'images/jamu_aloe_vera.jpg', 'aturan_pakai' => '1 kali sehari.', 'berat' => 200, 'stok' => 40, 'manfaat' => 'Laksatif ringan, menyejukkan.', 'id_kategori' => json_encode([7])],
            ['id_jamu' => 12, 'nama_jamu' => 'Jamu Kayu Manis Hangat', 'harga' => 15000, 'komposisi' => 'Kayu Manis, Jahe Merah', 'deskripsi' => 'Melancarkan peredaran darah.', 'gambar' => 'images/jamu_kayu_manis.jpg', 'aturan_pakai' => '2 kali sehari.', 'berat' => 150, 'stok' => 45, 'manfaat' => 'Vasodilator, menghangatkan.', 'id_kategori' => json_encode([4])],
            ['id_jamu' => 13, 'nama_jamu' => 'Jamu Daun Salam', 'harga' => 11000, 'komposisi' => 'Daun Salam, Kunyit', 'deskripsi' => 'Membantu menurunkan kolesterol.', 'gambar' => 'images/jamu_salam.jpg', 'aturan_pakai' => '1 kali sehari.', 'berat' => 170, 'stok' => 35, 'manfaat' => 'Hipolipidemik, antioksidan.', 'id_kategori' => json_encode([1])],
            ['id_jamu' => 14, 'nama_jamu' => 'Jamu Brotowali Tradisi', 'harga' => 12000, 'komposisi' => 'Brotowali, Kunyit', 'deskripsi' => 'Detoks liver dan ginjal.', 'gambar' => 'images/jamu_brotowali.jpg', 'aturan_pakai' => '1 kali sehari.', 'berat' => 160, 'stok' => 30, 'manfaat' => 'Hepatoprotektor, antimikroba.', 'id_kategori' => json_encode([7])],
            ['id_jamu' => 15, 'nama_jamu' => 'Jamu Pegal Linu Instan', 'harga' => 14000, 'komposisi' => 'Temu Lawak, Kunyit, Jahe', 'deskripsi' => 'Meredakan pegal dan nyeri otot.', 'gambar' => 'images/jamu_pegal.jpg', 'aturan_pakai' => '2 kali sehari.', 'berat' => 200, 'stok' => 50, 'manfaat' => 'Antiinflamasi, analgesik.', 'id_kategori' => json_encode([3, 6])],
            ['id_jamu' => 16, 'nama_jamu' => 'Jamu Masuk Angin Klasik', 'harga' => 13000, 'komposisi' => 'Jahe, Kencur, Temulawak', 'deskripsi' => 'Mencegah dan meredakan masuk angin.', 'gambar' => 'images/jamu_masuk_angin.jpg', 'aturan_pakai' => '2 kali sehari.', 'berat' => 180, 'stok' => 40, 'manfaat' => 'Anti masuk angin, pemanas tubuh.', 'id_kategori' => json_encode([2, 4, 3])],
            ['id_jamu' => 17, 'nama_jamu' => 'Jamu Detoks Herbal', 'harga' => 16000, 'komposisi' => 'Daun Dewa, Pegagan, Kunyit', 'deskripsi' => 'Membersihkan racun dalam tubuh.', 'gambar' => 'images/jamu_detoks.jpg', 'aturan_pakai' => '1 kali sehari.', 'berat' => 200, 'stok' => 25, 'manfaat' => 'Detoks, mendukung fungsi hati.', 'id_kategori' => json_encode([7, 1])],
            ['id_jamu' => 18, 'nama_jamu' => 'Jamu Jantung Sehat', 'harga' => 15500, 'komposisi' => 'Kayu Manis, Bawang Putih, Jahe', 'deskripsi' => 'Menjaga kesehatan jantung.', 'gambar' => 'images/jamu_jantung.jpg', 'aturan_pakai' => '1 kali sehari.', 'berat' => 170, 'stok' => 30, 'manfaat' => 'Hipotensif, antikoagulan ringan.', 'id_kategori' => json_encode([4])],
            ['id_jamu' => 19, 'nama_jamu' => 'Jamu Energi Pagi', 'harga' => 15000, 'komposisi' => 'Temulawak, Kencur, Gula Aren', 'deskripsi' => 'Memberi energi dan semangat pagi.', 'gambar' => 'images/jamu_energi.jpg', 'aturan_pakai' => 'Pagi hari sebelum sarapan.', 'berat' => 180, 'stok' => 45, 'manfaat' => 'Tonic, meningkatkan stamina.', 'id_kategori' => json_encode([3, 8])],
            ['id_jamu' => 20, 'nama_jamu' => 'Jamu Cap Lang Tradisi', 'harga' => 10000, 'komposisi' => 'Kunyit, Asam Jawa, Gula Batu', 'deskripsi' => 'Jamu cap lang formula klasik.', 'gambar' => 'images/jamu_caplang.jpg', 'aturan_pakai' => '2 kali sehari.', 'berat' => 190, 'stok' => 60, 'manfaat' => 'Antioksidan, penurun peradangan.', 'id_kategori' => json_encode([1, 5])],
        ];


        DB::table('jamu')->insert($jamu);
    }
}
