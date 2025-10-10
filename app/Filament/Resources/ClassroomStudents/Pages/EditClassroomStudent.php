<?php

namespace App\Filament\Resources\ClassroomStudents\Pages;

use App\Filament\Resources\ClassroomStudents\ClassroomStudentResource;
use App\Models\ClassroomStudent;
use App\Models\Report;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditClassroomStudent extends EditRecord
{
    protected static string $resource = ClassroomStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
        ];
    }
}
