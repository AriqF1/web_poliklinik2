<?php

namespace App\Filament\Resources\DokterResource\Pages;

use App\Filament\Resources\DokterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\Rule;

class EditDokter extends EditRecord
{
    protected static string $resource = DokterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function mutateFormDataBeforeSave(array $data): array
    {
        $userData = $data['user'] ?? [];
        unset($data['user']);

        if ($this->record) {
            $user = $this->record->user;

            // Validasi email unik saat update
            validator($userData, [
                'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            ])->validate();

            // Update user (password hanya jika diisi)
            if (!empty($userData['password'])) {
                $userData['password'] = bcrypt($userData['password']);
            } else {
                unset($userData['password']);
            }

            $user->update($userData);
        }

        return $data;
    }
}
