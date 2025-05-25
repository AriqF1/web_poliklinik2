<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Obat extends Model
{
    protected $fillable = [
        'nama_obat',
        'kemasan',
        'harga',
    ];

    public function detailPeriksa(): HasOne
    {
        return $this->hasOne(DetailPeriksa::class, 'id_obat');
    }
}
