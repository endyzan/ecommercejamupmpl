<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jamu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jamu';
    protected $primaryKey = 'id_jamu';
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
     * Soft delete untuk menghapus data tanpa menghapusnya secara permanen
     */

    protected $dates = ['deleted_at'];

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
