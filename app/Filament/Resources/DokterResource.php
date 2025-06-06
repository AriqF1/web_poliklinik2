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
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Validation\Rule;

class DokterResource extends Resource
{
    protected static ?string $model = Dokter::class;
    protected ?Dokter $record = null;
    protected static ?string $navigationGroup = 'Pengguna';
    protected static ?string $navigationLabel = 'Dokter';
    protected static ?string $title = 'Daftar Dokter';
    protected static ?string $label = 'Dokter';

    protected static ?string $navigationIcon = 'heroicon-s-user';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('user.name')
                            ->label('Nama Dokter')
                            ->helperText('Masukkan nama lengkap dokter')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('user.email')
                            ->label('Email')
                            ->helperText('Email yang digunakan untuk login')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('user.password')
                            ->label('Password')
                            ->helperText('Minimal 8 karakter')
                            ->password()
                            ->minLength(8)
                            ->dehydrateStateUsing(fn($state) => bcrypt($state))
                            ->required()
                            ->visible(fn($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord),

                        Forms\Components\TextInput::make('alamat')
                            ->label('Alamat')
                            ->helperText('Masukkan alamat tempat tinggal dokter')
                            ->required()
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('no_hp')
                            ->label('No. HP')
                            ->helperText('Nomor telepon aktif')
                            ->tel()
                            ->required()
                            ->maxLength(15),

                        Forms\Components\Select::make('poli_id')
                            ->label('Poli')
                            ->helperText('Pilih poli tempat dokter bertugas')
                            ->required()
                            ->relationship('poli', 'nama_poli')
                    ])
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('user.email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(30)
                    ->wrap(),

                TextColumn::make('no_hp')
                    ->label('Nomor HP')
                    ->formatStateUsing(fn($state) => '+62 ' . ltrim($state, '0'))
                    ->sortable(),

                BadgeColumn::make('poli.nama_poli')
                    ->label('Poli')
                    ->color('info')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('Belum ada dokter')
            ->emptyStateDescription('Klik tombol "Tambah Dokter" untuk mulai menambahkan data.')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
