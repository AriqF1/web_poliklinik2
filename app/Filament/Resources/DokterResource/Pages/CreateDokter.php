<?php

namespace App\Filament\Resources\DokterResource\Pages;

use App\Filament\Resources\DokterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User; // Pastikan User model diimpor
use Illuminate\Support\Facades\Hash; // Import Hash facade
use Illuminate\Support\Facades\Validator; // Import Validator facade
use Illuminate\Database\Eloquent\Model;


class CreateDokter extends CreateRecord
{
    protected static string $resource = DokterResource::class;

    /**
     * Mutate form data before creating the record.
     * This method manually creates the User record (with role and hashed password)
     * and then injects the created user's ID into the Dokter record's data.
     *
     * @param array $data The original form data, including 'user' sub-array.
     * @return array The mutated form data with 'user_id' set and 'user' sub-array removed.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $userData = $data['user'] ?? null;

        if (!$userData) {
            abort(422, 'Data user tidak ditemukan.');
        }

        // Validasi manual (opsional, tapi bagus untuk jaga‑jaga)
        validator($userData, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ])->validate();

        // Hapus array 'user' sebelum insert ke tabel 'dokters'
        unset($data['user']);

        // Buat User
        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $userData['password'], // sudah di‑hash di form
            'role' => 'dokter',
        ]);

        // Tambahkan foreign key
        $data['user_id'] = $user->id;

        return $data;
    }



}
