<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DokterResource\Pages;
use App\Filament\Resources\DokterResource\RelationManagers;
use App\Models\Dokter;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash; // Penting: Import Hash facade

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
                Forms\Components\Section::make('Data Akun')
                    ->description('Masukkan informasi login dokter.')
                    ->schema([
                        Forms\Components\Group::make()
                            ->relationship('user') // Filament akan mengisi field ini dari relasi user
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Dokter')
                                    ->helperText('Masukkan nama lengkap dokter')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->helperText('Email yang digunakan untuk login')
                                    ->email()
                                    // Validasi unik email di tabel 'users',
                                    // ignoreRecord: true penting saat mengedit agar email lama tidak dianggap duplikat.
                                    ->unique(User::class, 'email', ignoreRecord: true)
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('password')
                                    ->label('Password')
                                    ->helperText('Minimal 8 karakter. Kosongkan jika tidak ingin mengubah password.')
                                    ->password()
                                    ->revealable()
                                    ->minLength(8)
                                    // Menggunakan Hash::make() untuk mengenkripsi password sebelum disimpan.
                                    ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                                    // Hanya simpan password jika field ini diisi (saat create atau saat user mengubah password).
                                    ->dehydrated(fn(?string $state): bool => filled($state))
                                    // Password wajib hanya saat operasi 'create' (membuat dokter baru).
                                    ->required(fn(string $operation): bool => $operation === 'create')
                                    ->hintIcon('heroicon-m-information-circle')
                                    ->hintIconTooltip('Password minimal 8 karakter. Kosongkan jika tidak ingin mengubah password.'),
                            ])->columns(2)
                    ]),

                Forms\Components\Section::make('Data Dokter')
                    ->description('Masukkan informasi pribadi dokter dan poli tugas.')
                    ->schema([
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
                            ->relationship('poli', 'nama_poli'),
                    ])
                    ->columns(2),
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('user');
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

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
