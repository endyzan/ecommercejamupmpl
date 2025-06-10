<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Nama tabel jika tidak mengikuti konvensi (jamak)
    protected $table = 'transaksi';

    // Primary key kustom
    protected $primaryKey = 'id_transaksi';

    // Primary key bertipe integer dan auto increment
    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang bisa di-*mass assign*
    protected $fillable = [
        'tanggal_transaksi',
        'total_transaksi',
        'status_pembayaran', // 0 = Belum Bayar, 1 = Dikemas. // 2 = Dikirim, 3 = Diterima, 4 = Dibatalkan
        'id_user',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
    ];


    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function detilTransaksi()
    {
        return $this->hasMany(DetilTransaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
