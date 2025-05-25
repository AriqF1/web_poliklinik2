<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    protected $fillable = [
        'user_id',
        'alamat',
        'no_ktp',
        'no_hp',
        'no_rm',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function daftarPoli(): HasMany
    {
        return $this->hasMany(DaftarPoli::class, 'id_pasien');
    }
}
