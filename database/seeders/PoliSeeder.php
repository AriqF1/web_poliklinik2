<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = [
            [
                'nama_poli' => 'Poli Umum',
                'keterangan' => 'Menangani pemeriksaan umum dan ringan',
            ],
            [
                'nama_poli' => 'Poli Gigi',
                'keterangan' => 'Menangani masalah kesehatan gigi dan mulut',
            ],
            [
                'nama_poli' => 'Poli Anak',
                'keterangan' => 'Melayani pemeriksaan dan konsultasi kesehatan anak',
            ],
        ];

        foreach ($polis as $poli) {
            Poli::create($poli);
        }
    }
}
