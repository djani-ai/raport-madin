<?php

namespace App\Filament\Resources\ClassroomStudents\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClassroomStudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('classroom_id')
                    ->required()
                    ->numeric(),
                TextInput::make('student_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
