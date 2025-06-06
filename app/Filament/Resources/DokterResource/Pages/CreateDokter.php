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

        $userData = $data['user'] ?? [];
        unset($data['user']);

        $user = \App\Models\User::create([
            ...$userData,
            'role' => 'dokter',
            'password' => bcrypt($userData['password']),
        ]);

        $data['user_id'] = $user->id;

        return $data;
    }
}
