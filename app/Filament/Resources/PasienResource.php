<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PasienResource\Pages;
use App\Filament\Resources\PasienResource\RelationManagers;
use App\Models\Pasien;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PasienResource extends Resource
{
    protected static ?string $model = Pasien::class;
    protected ?Pasien $record = null;
    protected static ?string $navigationGroup = 'Pengguna';
    protected static ?string $navigationLabel = 'Pasien';
    protected static ?string $title = 'Daftar Pasien';
    protected static ?string $label = 'Pasien';

    protected static ?string $navigationIcon = 'heroicon-s-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Akun')
                    ->description('Masukkan informasi login pasien.')
                    ->schema([
                        Forms\Components\TextInput::make('user.name')
                            ->label('Nama Lengkap')
                            ->placeholder('Contoh: Ahmad Ramadhan')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('user.email')
                            ->label('Email')
                            ->placeholder('contoh@email.com')
                            ->email()
                            ->required()
                            ->unique(User::class, 'email', fn($record) => $record)
                            ->maxLength(255),

                        Forms\Components\TextInput::make('user.password')
                            ->label('Kata Sandi')
                            ->placeholder('Minimal 8 karakter')
                            ->password()
                            ->minLength(8)
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Data Pasien')
                    ->description('Masukkan informasi pribadi pasien.')
                    ->schema([
                        Forms\Components\TextInput::make('no_ktp')
                            ->label('No. KTP')
                            ->placeholder('Contoh: 327508xxxxxxx')
                            ->required()
                            ->unique(\App\Models\Pasien::class, 'no_ktp', fn($record) => $record)
                            ->maxLength(20),

                        Forms\Components\TextInput::make('no_hp')
                            ->label('No. HP')
                            ->placeholder('Contoh: 08123456789')
                            ->tel()
                            ->required()
                            ->maxLength(15),

                        Forms\Components\TextInput::make('alamat')
                            ->label('Alamat')
                            ->placeholder('Contoh: Jl. Merdeka No. 123, Bandung')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_rm')
                    ->label('No. RM')
                    ->sortable()
                    ->searchable()
                    ->copyable()
                    ->copyMessage('No. RM disalin!')
                    ->copyMessageDuration(1500)
                    ->color('primary'),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Pasien')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('no_ktp')
                    ->label('No. KTP')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('no_hp')
                    ->label('No. HP')
                    ->formatStateUsing(fn($state) => '+62 ' . ltrim($state, '0'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(40)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Terdaftar Sejak')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('Belum ada pasien')
            ->emptyStateDescription('Klik tombol "Tambah Pasien" untuk menambahkan data baru.')
            ->actions([
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
            'index' => Pages\ListPasiens::route('/'),
            'create' => Pages\CreatePasien::route('/create'),
            'edit' => Pages\EditPasien::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
