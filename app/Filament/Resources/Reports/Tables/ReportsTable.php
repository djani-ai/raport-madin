<?php

namespace App\Filament\Resources\Reports\Tables;

use App\Models\Report;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPdf\Facades\Pdf as FacadesPdf;
use Torgodly\Html2Media\Actions\Html2MediaAction;

class ReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('school_year.name')
                //     ->label('Tahun Ajaran')
                //     ->sortable(),
                TextColumn::make('student.name')
                    ->label('Santri')
                    ->sortable(),
                // TextColumn::make('classroom.name')
                //     ->label('Kelas')
                //     ->sortable(),
                TextColumn::make('total_score')
                    ->label('Total Nilai')
                    ->sortable(),
                TextColumn::make('average_score')
                    ->label('Rata2')
                    ->sortable(),
                TextColumn::make('rank')
                    ->label('Rangking')
                    ->sortable(),
                // TextColumn::make('presense_sick')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('presense_permission')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('presense_absen')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('behavior'),
                // TextColumn::make('orderly'),
                // TextColumn::make('perseverance'),
                // TextColumn::make('status_up'),
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
                    ->default('Pilih Kelas')
            ], layout: FiltersLayout::AboveContent)->deferFilters(false)
            ->recordActions([
                EditAction::make()
                    ->label('Lengkapi'),
                Action::make('Lihat HTML')
                    ->label('Lihat HTML')
                    ->color('info')
                    ->icon('heroicon-s-eye')
                    ->url(fn(Report $record): string => route('raport.preview', ['record' => $record]))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
