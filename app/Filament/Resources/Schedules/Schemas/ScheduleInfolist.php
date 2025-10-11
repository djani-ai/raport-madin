<?php

namespace App\Filament\Resources\Schedules\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;

class ScheduleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Input Nilai Santri')
                    // ->description('Status Nilai Saat Ini : '.)
                    ->schema([
                        TextEntry::make('school_year.name')
                            ->label('Tahun Pelajaran'),
                        TextEntry::make('classroom.name')
                            ->label('Kelas'),
                        TextEntry::make('subject.name')
                            ->label('Mata Pelajaran'),
                        TextEntry::make('teacher.name')
                            ->label('Ustadz / Ustadzah'),
                        IconEntry::make('lock_value_status')
                            ->label('Status Nilai')
                            ->boolean()
                            ->trueIcon('heroicon-s-lock-closed')
                            ->falseIcon('heroicon-s-lock-open')
                            ->trueColor('info')
                            ->falseColor('warning'),
                        TextEntry::make('created_at')
                            ->label('dibuat')
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->label('diupdate')
                            ->dateTime(),
                    ])->columns(3)->columnSpanFull(),
                // Section::make('Test')
                //     ->description('tes')
                //     ->schema([
                //         TextEntry::make('student.name')
                //             ->label('Santri'),
                //         TextEntry::make('value')
                //             ->label('Nilai')
                //     ])
                // TextEntry::make('created_at'),
                // TextEntry::make('updated_at'),

            ]);
    }
}
