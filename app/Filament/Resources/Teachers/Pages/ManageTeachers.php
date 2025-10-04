<?php

namespace App\Filament\Resources\Teachers\Pages;

use App\Filament\Resources\Teachers\TeacherResource;
use App\Imports\TeacherImport;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use EightyNine\ExcelImport\ExcelImportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use Filament\Actions\Action;



class ManageTeachers extends ManageRecords
{
    protected static string $resource = TeacherResource::class;

    protected function getHeaderActions(): array
    {
        $resourceName = str_replace('Resource', '', class_basename(static::$resource));
        $filename = strtolower($resourceName) . '_' . date('Y-m-d_h-i-s');
        return [
            CreateAction::make()
                ->label('Tambah')
                ->color('danger')
                ->icon('heroicon-o-plus'),
            ExcelImportAction::make()
                ->color('success')
                ->icon('heroicon-o-cloud-arrow-up')
                ->use(TeacherImport::class)
                ->sampleFileExcel(
                    url: url('file/TemplateUstad.xls'),
                    sampleButtonLabel: 'Download Sample',
                    customiseActionUsing: fn(Action $action) => $action->color('primary')
                        ->icon('heroicon-m-clipboard')
                        ->requiresConfirmation(),
                ),
            ExportAction::make()
                ->color('info')
                ->icon('heroicon-o-cloud-arrow-down')
                ->exports([
                    ExcelExport::make()->withColumns([
                        Column::make('no')->heading('No')
                            ->formatStateUsing(fn($state, $rowLoop) => $rowLoop->iteration),
                        Column::make('nip')->heading('NIP'),
                        Column::make('name')->heading('Nama Lengkap'),
                        Column::make('phone')->heading('No. HP'),
                        Column::make('address')->heading('Alamat'),
                        Column::make('specialization')->heading('Mapel Utama'),
                    ])
                        ->withFilename($filename)
                ])
        ];
    }
}
