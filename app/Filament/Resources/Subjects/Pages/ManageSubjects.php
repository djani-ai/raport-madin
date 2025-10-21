<?php

namespace App\Filament\Resources\Subjects\Pages;

use App\Filament\Resources\Subjects\SubjectResource;
use App\Imports\SubjectImport;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Actions\Action as ActionsAction;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;

class ManageSubjects extends ManageRecords
{
    protected static string $resource = SubjectResource::class;

    protected function getHeaderActions(): array
    {
        $filename = 'Mata_Pelajaran' . '_' . date('Y-m-d_h-i-s');
        return [
            CreateAction::make()
                ->label('Tambah')
                ->color('danger')
                ->icon('heroicon-o-plus'),
            ExcelImportAction::make()
                ->color('success')
                ->modalHeading('Import Mata Pelajaran')
                ->modalDescription('Import data mata pelajaran dari file Excel')
                ->slideOver()
                ->use(SubjectImport::class)
                ->validateUsing([
                    'name' => ['required', 'unique:subjects,name'],
                ])
                ->sampleFileExcel(
                    url: url('file/TemplateMapel.xls'),
                    sampleButtonLabel: 'Download Template',
                    customiseActionUsing: fn(ActionsAction $action) => $action->color('primary')
                        ->icon('heroicon-m-clipboard')
                        ->requiresConfirmation(),
                ),
            ExportAction::make()
                ->color('info')
                ->icon('heroicon-o-cloud-arrow-down')
                ->exports([
                    ExcelExport::make()->withColumns([
                        Column::make('no')->heading('No'),
                        Column::make('name')->heading('Nama'),
                        Column::make('arabic_name')->heading('Nama Bahasa Arab'),
                    ])
                        ->withFilename($filename)
                ])
        ];
    }
}
