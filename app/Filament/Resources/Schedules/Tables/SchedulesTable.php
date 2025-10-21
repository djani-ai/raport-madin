<?php

namespace App\Filament\Resources\Schedules\Tables;

use App\Filament\Exports\ScheduleExporter;
use App\Imports\ScheduleValuesImport;
use App\Models\Schedule;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
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
                    ->falseColor('warning'),
            ])
            ->filters([
                SelectFilter::make('class')
                    ->relationship('classroom', 'name', hasEmptyOption: true)
                    ->emptyRelationshipOptionLabel('Pilih Kelas')
                    ->selectablePlaceholder(false)
                    ->default('Pilih Kelas')
                    ->label('Filter Kelas'),
            ], layout: FiltersLayout::AboveContent)->deferFilters(false)->hiddenFilterIndicators()

            ->recordActions([
                ViewAction::make()
                    ->icon('heroicon-o-document-chart-bar')
                    ->label('Input Nilai')
                    ->color('success'),

                // ExcelImportAction::make('importValues')
                //     ->label('Import Nilai')
                //     ->icon('heroicon-o-cloud-arrow-up')
                //     ->color('primary')
                //     ->use(ScheduleValuesImport::class)
                //     ->sampleExcel(
                //         sampleData: [
                //             ['name' => 'John Doe', 'email' => 'john@doe.com', 'phone' => '123456789'],
                //             ['name' => 'Jane Doe', 'email' => 'jane@doe.com', 'phone' => '987654321'],
                //         ],
                //         fileName: 'sample.xlsx',
                //         exportClass: ScheduleExporter::class,
                //         sampleButtonLabel: 'Download Sample',
                //         customiseActionUsing: fn(Action $action) => $action->color('secondary')
                //             ->icon('heroicon-m-clipboard')
                //             ->requiresConfirmation()
                //     )
                //     ->after(function (Schedule $record) {
                //         Notification::make()
                //             ->title('Berhasil mengimpor nilai untuk jadwal ' . $record->subject->name)
                //             ->success()
                //             ->send();
                //     }),



                // Action::make('lock_value_status'),

            ])
            ->headerActions([])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
