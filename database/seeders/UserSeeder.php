<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        $userPasien = User::create([
            'name' => 'alamsyah',
            'email' => 'alamsyah@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);
        Pasien::create([
            'user_id' => $userPasien->id,
            'alamat' => 'Jl. Kesehatan No. 1',
            'no_ktp' => '1234567890123456',
            'no_hp' => '081234567890',
        ]);

        $dokterList = [
            [
                'name' => 'dr. Boho',
                'email' => 'boho@gmail.com',
                'alamat' => 'Jl. Sehat Selalu 1',
                'no_hp' => '089876543211',
                'poli_id' => 1,
            ],
            [
                'name' => 'dr. Citra',
                'email' => 'citra@gmail.com',
                'alamat' => 'Jl. Sehat Selalu 2',
                'no_hp' => '089876543212',
                'poli_id' => 2,
            ],
            [
                'name' => 'dr. Dharma',
                'email' => 'dharma@gmail.com',
                'alamat' => 'Jl. Sehat Selalu 3',
                'no_hp' => '089876543213',
                'poli_id' => 3,
            ],
        ];

        foreach ($dokterList as $dokter) {
            $user = User::create([
                'name' => $dokter['name'],
                'email' => $dokter['email'],
                'password' => Hash::make('password'),
                'role' => 'dokter',
            ]);

            Dokter::create([
                'user_id' => $user->id,
                'alamat' => $dokter['alamat'],
                'no_hp' => $dokter['no_hp'],
                'poli_id' => $dokter['poli_id'],
            ]);
        }
    }
}
