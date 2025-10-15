<?php

namespace App\Filament\Resources\GenerateLegers\Pages;

use App\Filament\Resources\GenerateLegers\GenerateLegerResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditGenerateLeger extends EditRecord
{
    protected static string $resource = GenerateLegerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // ViewAction::make(),
            // DeleteAction::make(),
        ];
    }
}
