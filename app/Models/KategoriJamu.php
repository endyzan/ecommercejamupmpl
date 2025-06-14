<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriJamu extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'kategori';

    // Primary key dari tabel
    protected $primaryKey = 'id_kategori';

    // Kolom yang dapat diisi (mass assignment)
    protected $fillable = ['nama_kategori'];

    // Jika diperlukan, tambahkan relasi dengan model Jamu
    public function jamus()
    {
        return $this->hasMany(Jamu::class, 'id_kategori', 'id_kategori');
    }
}
