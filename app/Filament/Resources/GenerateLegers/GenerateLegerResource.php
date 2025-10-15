<?php

namespace App\Filament\Resources\GenerateLegers;

use App\Filament\Resources\GenerateLegers\Pages\CreateGenerateLeger;
use App\Filament\Resources\GenerateLegers\Pages\EditGenerateLeger;
use App\Filament\Resources\GenerateLegers\Pages\ListGenerateLegers;
use App\Filament\Resources\GenerateLegers\Pages\ViewGenerateLeger;
use App\Filament\Resources\GenerateLegers\Schemas\GenerateLegerForm;
use App\Filament\Resources\GenerateLegers\Schemas\GenerateLegerInfolist;
use App\Filament\Resources\GenerateLegers\Tables\GenerateLegersTable;
use App\Models\GenerateLeger;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class GenerateLegerResource extends Resource
{
    protected static ?string $model = GenerateLeger::class;
    protected static string | UnitEnum | null $navigationGroup = 'Akademik';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Leger';
    protected static ?string $label = 'Leger';
    protected static ?string $pluralLabel = 'Leger';
    protected static ?string $slug = 'leger';

    public static function form(Schema $schema): Schema
    {
        return GenerateLegerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return GenerateLegerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GenerateLegersTable::configure($table);
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
            'index' => ListGenerateLegers::route('/'),
            'create' => CreateGenerateLeger::route('/create'),
            'view' => ViewGenerateLeger::route('/{record}'),
            'edit' => EditGenerateLeger::route('/{record}/edit'),
        ];
    }
}
