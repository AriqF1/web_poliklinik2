<?php

namespace App\Filament\Resources\PasienResource\Pages;

use App\Filament\Resources\PasienResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePasien extends CreateRecord
{
    protected static string $resource = PasienResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $userData = $data['user'] ?? [];
        unset($data['user']);

        $user = \App\Models\User::create([
            ...$userData,
            'role' => 'pasien',
            'password' => bcrypt($userData['password']),
        ]);

        $data['user_id'] = $user->id;

        return $data;
    }
}
