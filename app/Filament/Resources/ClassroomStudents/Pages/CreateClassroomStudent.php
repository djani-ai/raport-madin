<?php

namespace App\Filament\Resources\ClassroomStudents\Pages;

use App\Filament\Resources\ClassroomStudents\ClassroomStudentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateClassroomStudent extends CreateRecord
{
    protected static string $resource = ClassroomStudentResource::class;
}
