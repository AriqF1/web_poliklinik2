<?php

namespace App\Filament\Resources\DokterResource\Pages;

use App\Filament\Resources\DokterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDokter extends CreateRecord
{
    protected static string $resource = DokterResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ambil data user
        $userData = $data['user'] ?? [];
        unset($data['user']);

        // Buat user dulu
        $user = \App\Models\User::create([
            ...$userData,
            'role' => 'dokter',
            'password' => bcrypt($userData['password']),
        ]);

        // Masukkan user_id ke data dokter
        $data['user_id'] = $user->id;

        return $data;
    }
}
