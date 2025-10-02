<?php

namespace App\Filament\Resources\SubjectGrades\Pages;

use App\Filament\Resources\SubjectGrades\SubjectGradeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSubjectGrades extends ManageRecords
{
    protected static string $resource = SubjectGradeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
