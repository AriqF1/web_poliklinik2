<?php

namespace App\Filament\Resources\DokterResource\Pages;

use App\Filament\Resources\DokterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateDokter extends CreateRecord
{
    protected static string $resource = DokterResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $userData = $data['user'] ?? null;

        if (!$userData) {
            throw ValidationException::withMessages([
                'user.name' => 'Data akun dokter (nama, email, password) tidak boleh kosong.',
            ]);
        }

        // DEBUG: Cek data user setelah validasi form Filament, sebelum validasi manual
        dd('Data user dari form:', $userData); // Hapus ini setelah selesai debugging

        Validator::make($userData, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ])->validate();

        // DEBUG: Cek data user setelah validasi manual, sebelum pembuatan User
        // dd('Data user setelah validasi manual:', $userData); // Hapus ini setelah selesai debugging


        try {
            // Buat record User baru
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'], // Password seharusnya sudah di-hash dari form
                'role' => 'dokter',
            ]);
        } catch (\Exception $e) {
            // DEBUG: Tangkap dan tampilkan error jika pembuatan User gagal
            dd('Error saat membuat User:', $e->getMessage(), $e->getTraceAsString()); // Hapus ini setelah selesai debugging
        }


        // DEBUG: Cek objek User yang baru dibuat
        // dd('User yang baru dibuat:', $user); // Hapus ini setelah selesai debugging


        unset($data['user']);

        // DEBUG: Cek data akhir sebelum dikembalikan
        // dd('Data Dokter sebelum disimpan:', $data); // Hapus ini setelah selesai debugging

        $data['user_id'] = $user->id;

        return $data;
    }
}
