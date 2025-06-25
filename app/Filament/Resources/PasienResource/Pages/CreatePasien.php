<?php

namespace App\Filament\Resources\PasienResource\Pages;

use App\Filament\Resources\PasienResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;

class CreatePasien extends CreateRecord
{
    protected static string $resource = PasienResource::class;
    /**
     * Mutate form data before creating the record.
     * This method is used to add the 'role' to the user data
     * before Filament's relationship() component handles the user creation.
     *
     * @param array $data The original form data.
     * @return array The mutated form data.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data['user'])) {
            $data['user']['role'] = 'pasien';
        } else {
            $data['user'] = ['role' => 'pasien'];
        }
        return $data;
    }
}
