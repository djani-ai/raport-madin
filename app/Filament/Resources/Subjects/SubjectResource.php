<?php

namespace App\Filament\Resources\Subjects;

use App\Filament\Resources\Subjects\Pages\ManageSubjects;
use App\Models\Subject;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;
    protected static ?string $recordTitleAttribute = 'Mata Pelajaran';
    protected static string | UnitEnum | null $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Mata Pelajaran';
    protected static ?string $label = 'Mata Pelajaran';
    protected static ?string $pluralLabel = 'Mata Pelajaran';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Nomor Urut Mata Pelajaran')
                    ->schema([
                        TextInput::make('no')
                            ->label('No Urut Mata Pelajaran')
                            ->numeric()
                            ->required()
                            ->unique(ignorable: fn($record) => $record)
                            ->helperText('Akan digunakan untuk mengurutkan mata pelajaran pada saat input nilai siswa.'),
                    ]),
                Section::make('Nama Mata Pelajaran')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Mata Pelajaran')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('arabic_name')
                            ->label('Nama Mata Pelajaran (Arab)')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->secondary()
                    ->compact()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Subject')
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                TextColumn::make('name')
                    ->label('Nama Mata Pelajaran')
                    ->searchable(),
                TextColumn::make('arabic_name')
                    ->label('Nama Mata Pelajaran (Arab)')
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
                DeleteAction::make(),
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
            'index' => ManageSubjects::route('/'),
        ];
    }
}
