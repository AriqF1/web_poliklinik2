<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    protected static function booted()
    {
        static::creating(function ($pasien) {
            $ktpExists = self::where('no_ktp', $pasien->no_ktp)->exists();

            if (! $ktpExists) {
                $yearMonth = now()->format('Ym');
                $total = self::count() + 1;
                $pasien->no_rm = $yearMonth . '-' . $total;
            }
        });
    }
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
