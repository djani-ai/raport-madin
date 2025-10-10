<?php

namespace App\Filament\Resources\ClassroomStudents\Pages;

use App\Filament\Resources\ClassroomStudents\ClassroomStudentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListClassroomStudents extends ListRecords
{
    protected static string $resource = ClassroomStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
