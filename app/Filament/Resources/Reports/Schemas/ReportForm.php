<?php

namespace App\Filament\Resources\Reports\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Nilai')
                    // ->inlineLabel()
                    ->schema([
                        // Select::make('school_year_id')
                        //     ->relationship('school_year', 'name')
                        //     ->disabled(),
                        Select::make('student_id')
                            ->label('Santri')
                            ->relationship('student', 'name')
                            ->disabled()
                            ->columnspan(3),
                        Select::make('classroom_id')
                            ->label('Kelas')
                            ->relationship('classroom', 'name')
                            ->disabled()
                            ->columnspan(2),
                        TextInput::make('total_score')
                            ->label('Total Nilai')
                            ->disabled()
                            ->columnspan(2),
                        TextInput::make('average_score')
                            ->label('Rata-Rata')
                            ->disabled()
                            ->columnspan(2),
                        TextInput::make('rank')
                            ->disabled()
                            ->columnspan(1),
                    ])->columns(10)->columnSpanFull(),
                Section::make('Perilaku')
                    ->description('')
                    ->schema([
                        Select::make('behavior')
                            ->options(['A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E']),
                        Select::make('orderly')
                            ->options(['A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E']),
                        Select::make('perseverance')
                            ->options(['A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E']),
                        // Select::make('status_up')
                        //     ->options(['Naik' => 'Naik', 'Tinggal' => 'Tinggal', 'Lulus' => 'Lulus']),
                    ])
                    ->columns(3),
                Section::make('Absensi')
                    ->description('')
                    ->schema([
                        TextInput::make('presense_sick')
                            ->label('Sakit')
                            ->numeric(),
                        TextInput::make('presense_permission')
                            ->label('Izin')
                            ->numeric(),
                        TextInput::make('presense_absen')
                            ->label('Alpha')
                            ->numeric(),
                    ])
                    ->columns(3),
                Section::make('Catatan')
                    ->description('')
                    ->inlineLabel()
                    ->schema([
                        Textarea::make('guardian_note')
                            ->label('Catatan Wali Kelas')
                            ->columnSpanFull()
                            ->rows(4),
                        Textarea::make('head_note')
                            ->label('Catatan Kepala')
                            ->columnSpanFull()
                            ->rows(4),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
