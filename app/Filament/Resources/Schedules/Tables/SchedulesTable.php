<?php

namespace App\Filament\Resources\Schedules\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
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
                IconColumn::make('lock_value_status')
                    ->label('Status Nilai')
                    ->boolean()
                    ->trueIcon('heroicon-s-lock-closed')
                    ->falseIcon('heroicon-s-lock-open')
                    ->trueColor('info')
                    ->falseColor('warning')
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
                SelectFilter::make('class')
                    ->relationship('classroom', 'name', hasEmptyOption: true)
                    ->emptyRelationshipOptionLabel('Pilih Kelas')
                    ->selectablePlaceholder(false)
                    ->default('Pilih Kelas')
            ], layout: FiltersLayout::AboveContent)->deferFilters(false)
            ->recordActions([
                ViewAction::make()
                    ->icon('heroicon-o-document-chart-bar')
                    ->label('Input Nilai')
                    ->color('success'),
                // Action::make('lock_value_status'),

            ])

            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
