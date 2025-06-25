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
}
