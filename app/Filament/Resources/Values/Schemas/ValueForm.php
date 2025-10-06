<?php

namespace App\Filament\Resources\Values\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ValueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('school_year_id')
                    ->required()
                    ->numeric(),
                TextInput::make('classroom_id')
                    ->required()
                    ->numeric(),
                TextInput::make('student_id')
                    ->required()
                    ->numeric(),
                TextInput::make('subject_id')
                    ->required()
                    ->numeric(),
                TextInput::make('teacher_id')
                    ->required()
                    ->numeric(),
                TextInput::make('value')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
