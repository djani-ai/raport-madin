<?php

namespace App\Filament\Resources\Schedules;

use App\Filament\Resources\ScheduleResource\RelationManagers\StudentRelationManager;
use App\Filament\Resources\Schedules\Pages\CreateSchedule;
use App\Filament\Resources\Schedules\Pages\EditSchedule;
use App\Filament\Resources\Schedules\Pages\ListSchedules;
use App\Filament\Resources\Schedules\Pages\ViewSchedule;
use App\Filament\Resources\Schedules\RelationManagers\ValuesRelationManager;
use App\Filament\Resources\Schedules\Resources\Values\ValueResource;
use App\Filament\Resources\Schedules\Schemas\ScheduleForm;
use App\Filament\Resources\Schedules\Schemas\ScheduleInfolist;
use App\Filament\Resources\Schedules\Tables\SchedulesTable;
use App\Models\Schedule;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Input Nilai';
    protected static string | UnitEnum | null $navigationGroup = 'Akademik';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Input Nilai';
    protected static ?string $label = 'Input Nilai';
    protected static ?string $pluralLabel = 'Input Nilai';
    protected static ?string $slug = 'value';



    public static function form(Schema $schema): Schema
    {
        return ScheduleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ScheduleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SchedulesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            'values' => ValuesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSchedules::route('/'),
            'view' => ViewSchedule::route('/{record}'),
            'edit' => EditSchedule::route('/{record}/edit'),
        ];
    }
}
