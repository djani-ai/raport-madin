<?php

namespace App\Filament\Resources\Schedules\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;

class ScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('school_year_id')
                    ->relationship('school_year', 'name')
                    ->disabled(),
                Select::make('classroom_id')
                    ->relationship('classroom', 'name')
                    ->disabled(),
                Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->disabled(),
                Select::make('teacher_id')
                    ->relationship('teacher', 'name')
                    ->disabled(),
            ]);
    }
}
