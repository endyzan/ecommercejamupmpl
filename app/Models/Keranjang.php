<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    // Nama tabel (jika tidak menggunakan konvensi plural Laravel)
    protected $table = 'keranjang';

    // Primary key kustom
    protected $primaryKey = 'id_keranjang';

    // Jika primary key bukan incrementing 'id', tentukan tipe datanya
    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'id_jamu',
        'id_user',
    ];

    /**
     * Relasi ke model Jamu
     */
    public function jamu()
    {
        return $this->belongsTo(Jamu::class, 'id_jamu', 'id_jamu');
    }

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
