<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Komentar extends Model
{
    protected $table = 'komentar';
    protected $primaryKey = 'id_komentar';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'komentar',
        'rating',
        'id_jamu',
        'id_user',
    ];

    /**
     * Relasi ke model Jamu
     */
    public function jamu(): BelongsTo
    {
        return $this->belongsTo(Jamu::class, 'id_jamu', 'id_jamu');
    }

    /**
     * Relasi ke model User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
