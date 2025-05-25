<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Poli extends Model
{
    protected $fillable = [
        'nama_poli',
        'keterangan',
    ];

    public function dokter(): HasOne
    {
        return $this->hasOne(Dokter::class, 'poli_id');
    }
}
