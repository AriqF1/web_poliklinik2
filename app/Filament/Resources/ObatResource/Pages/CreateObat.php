<?php

namespace App\Filament\Resources\ObatResource\Pages;

use App\Filament\Resources\ObatResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateObat extends CreateRecord
{
    protected static string $resource = ObatResource::class;
    protected static ?string $title = 'Tambah Obat';
}
