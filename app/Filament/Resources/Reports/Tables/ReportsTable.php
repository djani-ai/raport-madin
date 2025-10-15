<?php

namespace App\Filament\Resources\Reports\Tables;

use App\Models\Report;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class ReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.name')
                    ->label('Santri')
                    ->sortable(),
                TextColumn::make('total_score')
                    ->label('Total Nilai')
                    ->sortable(),
                TextColumn::make('average_score')
                    ->label('Rata2')
                    ->sortable(),
                TextColumn::make('rank')
                    ->label('Rangking')
                    ->sortable(),
                TextColumn::make('print_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('Kelas')
                    ->relationship('classroom', 'name', hasEmptyOption: true)
                    ->emptyRelationshipOptionLabel('Pilih Kelas')
                    ->selectablePlaceholder(false)
                    ->default('Pilih Kelas'),
            ], layout: FiltersLayout::AboveContent)->deferFilters(false)->hiddenFilterIndicators()->filtersFormWidth(Width::Medium)
            ->recordActions([
                EditAction::make()
                    ->label('Lengkapi'),
                Action::make('cetak')
                    ->label('Cover')
                    ->icon('heroicon-o-printer')
                    ->color('danger')
                    ->url(fn(Report $record): string => route('report.cetak', $record)),
                Action::make('cetak')
                    ->label('Raport PDF')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->url(fn(Report $record): string => route('report.cetak', $record)),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
