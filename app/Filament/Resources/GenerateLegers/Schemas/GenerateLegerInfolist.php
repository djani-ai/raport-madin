<?php

namespace App\Filament\Resources\GenerateLegers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GenerateLegerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Fieldset::make()
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Nama'),
                                TextEntry::make('level')
                                    ->label('Tingkatan'),
                            ])
                            ->columns(3),
                    ])
                    ->columnSpanFull(),
                Section::make()
                    ->schema([
                        Fieldset::make()
                            ->schema([])
                            ->columns(3),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
