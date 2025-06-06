<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PoliResource\Pages;
use App\Filament\Resources\PoliResource\RelationManagers;
use App\Models\Poli;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PoliResource extends Resource
{
    protected static ?string $model = Poli::class;
    protected static ?string $navigationGroup = 'Penyimpanan';
    protected static ?string $navigationLabel = 'Poli';
    protected static ?string $title = 'Daftar Poli';


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('nama_poli')
                        ->label('Nama Poli')
                        ->prefixIcon('heroicon-m-building-office')
                        ->placeholder('Contoh: Poli Gigi')
                        ->required()
                        ->maxLength(25),

                    Forms\Components\Textarea::make('keterangan')
                        ->label('Keterangan')
                        ->placeholder('Tuliskan deskripsi singkat tentang layanan poli ini')
                        ->autosize()
                        ->maxLength(255)
                        ->required(),
                ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('nama_poli')
                    ->label('Nama Poli')
                    ->description(fn(Poli $record) => $record->keterangan)
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada data Poli')
            ->emptyStateDescription('Klik "Tambah Poli" untuk mulai menambahkan data.');
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPolis::route('/'),
            'create' => Pages\CreatePoli::route('/create'),
            'edit' => Pages\EditPoli::route('/{record}/edit'),
        ];
    }
}
