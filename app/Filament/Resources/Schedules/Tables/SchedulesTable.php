<?php

namespace App\Filament\Resources\Schedules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('school_year.name')
                    ->label('Tahun Ajaran')
                    ->sortable(),
                TextColumn::make('classroom.name')
                    ->label('Kelas')
                    ->sortable(),
                TextColumn::make('subject.name')
                    ->label('Mata Pelajaran')
                    ->sortable(),
                TextColumn::make('teacher.name')
                    ->label('Ustadz / Ustadzah')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->icon('heroicon-o-document-chart-bar')
                    ->label('Input Nilai')
                    ->color('success'),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
