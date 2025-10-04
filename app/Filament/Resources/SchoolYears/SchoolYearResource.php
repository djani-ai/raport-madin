<?php

namespace App\Filament\Resources\SchoolYears;

use App\Filament\Resources\SchoolYears\Pages\ManageSchoolYears;
use App\Models\SchoolYear;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\Action;

class SchoolYearResource extends Resource
{
    protected static ?string $model = SchoolYear::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Settings';
    protected static ?string $recordTitleAttribute = 'name'; // tampilkan nama tahun ajaran

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Tahun Ajaran')
                ->required()
                ->placeholder('mis: 2025/2026'),

            Select::make('semester')
                ->options([
                    'Ganjil' => 'Ganjil',
                    'Genap' => 'Genap',
                ])
                ->required(),

            Toggle::make('is_active')
                ->label('Tahun Ajaran Aktif')
                ->afterStateUpdated(function ($state, $set, $get, $record) {
                    if ($state) {
                        // Nonaktifkan semua tahun ajaran lain
                        SchoolYear::where('id', '!=', $record?->id)->update(['is_active' => false]);
                    }
                }),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Tahun Ajaran')
                    ->searchable(),
                TextColumn::make('semester')
                    ->label('Semester'),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                // SelectColumn::make('is_active')
                //     ->label('Set Tahun Ajaran Aktif')
                //     ->optionsRelationship(fn(SchoolYear $record) => $record->update(['is_active' => true]))
                //     ->after(function (SchoolYear $record) {
                //         SchoolYear::where('id', '!=', $record->id)->update(['is_active' => false]);
                //     })
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                Action::make('setAsActive')
                    ->requiresConfirmation()
                    ->action(fn(SchoolYear $record) => $record->update(['is_active' => true]))
                    ->after(function (SchoolYear $record) {
                        SchoolYear::where('id', '!=', $record->id)->update(['is_active' => false]);
                    })
                    ->label('Set Aktif')
                    ->icon('heroicon-o-check-circle')
                    ->color('success'),
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
            'index' => ManageSchoolYears::route('/'),
        ];
    }
}
