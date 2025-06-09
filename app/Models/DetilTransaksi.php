<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetilTransaksi extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'detil_transaksi';

    // Primary key kustom
    protected $primaryKey = 'id_detil_transaksi';

    // Auto increment dan tipe data
    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang bisa diisi
    protected $fillable = [
        'jumlah',
        'id_jamu',
        'id_transaksi',
    ];

    // Relasi ke model Jamu
    public function jamu()
    {
        return $this->belongsTo(Jamu::class, 'id_jamu', 'id_jamu');
    }

    // Relasi ke model Transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
