<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jamu extends Model
{
    use HasFactory;

    protected $table = 'jamu';
    protected $fillable = [
        'nama_jamu',
        'harga',
        'komposisi',
        'deskripsi',
        'gambar',
        'aturan_pakai',
        'berat',
        'stok',
        'manfaat',
        'id_kategori',
        'fitur_index', // kolom tambahan agar mempercepat proses prediksi
    ];

    // Jika 'id_kategori' disimpan dalam bentuk JSON, kamu bisa mengaksesnya sebagai array
    protected $casts = [
        'id_kategori' => 'array',
    ];

    /**
     * Relasi ke model Komentar
     */
    public function komentar(): HasMany
    {
        return $this->hasMany(Komentar::class, 'id_jamu', 'id_jamu');
    }
    /**
     * Ambil data kategori berdasarkan isi dari id_kategori (array)
     * Ini bukan relasi Eloquent, tapi helper function
     */
    public function kategoris()
    {
        return KategoriJamu::whereIn('id', $this->id_kategori ?? [])->get();
    }
}
