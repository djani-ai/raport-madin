<?php

namespace App\Filament\Resources\GenerateLegers\Pages;

use App\Filament\Resources\GenerateLegers\GenerateLegerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewGenerateLeger extends ViewRecord
{
    protected static string $resource = GenerateLegerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }
}
