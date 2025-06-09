<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi jamak
    protected $table = 'alamat';

    // Tentukan primary key jika tidak menggunakan 'id'
    protected $primaryKey = 'id_alamat';

    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = [
        'alamat',
        'id_user',
    ];

    /**
     * Relasi ke model User (Many-to-One)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
