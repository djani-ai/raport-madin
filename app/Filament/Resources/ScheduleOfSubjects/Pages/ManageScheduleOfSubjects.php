<?php

namespace App\Filament\Resources\ScheduleOfSubjects\Pages;

use App\Filament\Resources\ScheduleOfSubjects\ScheduleOfSubjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageScheduleOfSubjects extends ManageRecords
{
    protected static string $resource = ScheduleOfSubjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
