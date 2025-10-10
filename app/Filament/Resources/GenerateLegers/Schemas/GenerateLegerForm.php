<?php

namespace App\Filament\Resources\GenerateLegers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GenerateLegerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('level')
                    ->options(['Awwaliyah' => 'Awwaliyah', 'Wustha' => 'Wustha', 'Ulya' => 'Ulya'])
                    ->required(),
                TextInput::make('hr_teacher_id')
                    ->numeric(),
                TextInput::make('school_year_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
