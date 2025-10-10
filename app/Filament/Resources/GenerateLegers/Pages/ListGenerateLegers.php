<?php

namespace App\Filament\Resources\GenerateLegers\Pages;

use App\Filament\Resources\GenerateLegers\GenerateLegerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGenerateLegers extends ListRecords
{
    protected static string $resource = GenerateLegerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
