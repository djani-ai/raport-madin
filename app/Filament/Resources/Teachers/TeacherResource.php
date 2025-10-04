<?php

namespace App\Filament\Resources\Teachers;

use App\Filament\Resources\Teachers\Pages\ManageTeachers;
use App\Models\Teacher;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $recordTitleAttribute = 'Ustadz/Ustadzah';
    protected static string | UnitEnum | null $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Ustadz/Ustadzah';
    protected static ?string $label = 'Ustadz/Ustadzah';
    protected static ?string $pluralLabel = 'Ustadz/Ustadzah';
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nip')
                    ->label('NIP')
                    ->unique(ignoreRecord: true),
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required(),
                TextInput::make('phone')
                    ->label('No. HP')
                    ->tel(),
                Textarea::make('address')
                    ->label('Alamat')
                    ->columnSpanFull(),
                FileUpload::make('signature')
                    ->label('Tanda Tangan')
                    ->image()
                    ->directory('signatures')
                    ->maxSize(1024)
                    ->columnSpanFull(),
                TextInput::make('specialization')
                    ->label('Mapel Utama'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Teacher')
            ->columns([
                TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('No. HP'),
                ImageColumn::make('signature')
                    ->label('Tanda Tangan'),
                TextColumn::make('specialization')
                    ->label('Mapel Utama')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Ustadz/Ustadzah')
                    ->modalSubheading('Apakah Anda yakin ingin menghapus Ustadz/Ustadzah ini? Tindakan ini tidak dapat dibatalkan.
                    ini Juga akan menghapus Login Email Ustadz/Ustadzah.')
                    ->modalButton('Hapus')
                    ->color('danger'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageTeachers::route('/'),
        ];
    }
}
