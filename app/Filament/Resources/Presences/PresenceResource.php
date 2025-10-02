<?php

namespace App\Filament\Resources\Presences;

use App\Filament\Resources\Presences\Pages\ManagePresences;
use App\Models\Presence;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class PresenceResource extends Resource
{
    protected static ?string $model = Presence::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Input Reports';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('school_year_id')
                    ->required()
                    ->numeric(),
                TextInput::make('students_id')
                    ->required()
                    ->numeric(),
                TextInput::make('sick')
                    ->numeric(),
                TextInput::make('permission')
                    ->numeric(),
                TextInput::make('absent')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('school_year_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('students_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sick')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('permission')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('absent')
                    ->numeric()
                    ->sortable(),
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
            'index' => ManagePresences::route('/'),
        ];
    }
}
