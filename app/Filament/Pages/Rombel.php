<?php

namespace App\Filament\Pages;

use App\Models\Grade;
use Filament\Pages\Page;
use UnitEnum;

class Rombel extends Page
{
    protected string $view = 'filament.pages.rombel';
    protected static ?string $recordTitleAttribute = 'Rombel';
    protected static string | UnitEnum | null $navigationGroup = 'Data';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Rombel';
    protected static ?string $label = 'Rombel';
    protected static ?string $pluralLabel = 'Rombel';
    protected static ?string $slug = 'rombel';
}
