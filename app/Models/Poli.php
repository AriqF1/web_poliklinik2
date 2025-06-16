<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poli extends Model
{
    protected $fillable = [
        'nama_poli',
        'keterangan',
    ];

    public function dokter(): HasMany
    {
        return $this->hasMany(Dokter::class, 'poli_id');
    }
}
