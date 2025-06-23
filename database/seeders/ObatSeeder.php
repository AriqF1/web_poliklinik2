<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obatList = [
            [
                'nama_obat' => 'Paracetamol',
                'kemasan' => 'Tablet 500mg, strip isi 10',
                'harga' => 5000,
            ],
            [
                'nama_obat' => 'Amoxicillin',
                'kemasan' => 'Kapsul 500mg, strip isi 10',
                'harga' => 7500,
            ],
            [
                'nama_obat' => 'Antalgin',
                'kemasan' => 'Tablet 500mg, strip isi 10',
                'harga' => 4500,
            ],
            [
                'nama_obat' => 'CTM',
                'kemasan' => 'Tablet 4mg, strip isi 10',
                'harga' => 3000,
            ],
            [
                'nama_obat' => 'Vitamin C',
                'kemasan' => 'Tablet 500mg, botol isi 30',
                'harga' => 10000,
            ],
        ];

        foreach ($obatList as $obat) {
            Obat::create($obat);
        }
    }
}
