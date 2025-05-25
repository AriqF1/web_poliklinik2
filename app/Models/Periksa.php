<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Periksa extends Model
{
    protected $fillable = [
        'id_daftar_poli',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
    ];

    public function daftarPoli(): BelongsTo
    {
        return $this->belongsTo(DaftarPoli::class, 'id_daftar_poli');
    }

    public function detailPeriksa(): HasOne
    {
        return $this->hasOne(DetailPeriksa::class, 'id_periksa');
    }
}
