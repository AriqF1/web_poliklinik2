<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DokterResource\Pages;
use App\Filament\Resources\DokterResource\RelationManagers;
use App\Models\Dokter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DokterResource extends Resource
{
    protected static ?string $model = Dokter::class;
    protected ?Dokter $record = null;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user.name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('user.email')
                    ->email()
                    ->required()
                    ->unique(Dokter::class, 'email', fn($record) => $record)
                    ->maxLength(255),
                Forms\Components\TextInput::make('user.password')
                    ->password()
                    ->minLength(8)
                    ->dehydrateStateUsing(fn($state) => bcrypt($state))
                    ->required(),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('no_hp')
                    ->tel()
                    ->required()
                    ->maxLength(15),
                Forms\Components\Select::make('poli_id')
                    ->required()
                    ->options(
                        \App\Models\Poli::all()->pluck('nama_poli', 'id')
                    )
                    ->searchable()
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('poli.nama_poli')
                    ->label('Poli')
                    ->sortable()
            ])->filters([
                //
            ])->actions([
                //
            ])->bulkActions([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListDokters::route('/'),
            'create' => Pages\CreateDokter::route('/create'),
            'edit' => Pages\EditDokter::route('/{record}/edit'),
        ];
    }

    public function mutateFormDataBeforeSave(array $data): array
    {
        $userData = $data['user'] ?? [];
        unset($data['user']);

        if ($this->record) {
            $this->record->user()->update($userData);
        } else {
            $user = \App\Models\User::create($userData + ['role' => 'dokter']);
            $data['user_id'] = $user->id;
        }

        return $data;
    }
}
