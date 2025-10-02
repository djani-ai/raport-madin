<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Resources\Students\StudentResource;
use App\Imports\StudentImport;
use COM;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;

class ManageStudents extends ManageRecords
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        $resourceName = str_replace('Resource', '', class_basename(static::$resource));
        $filename = strtolower($resourceName) . '_' . date('Y-m-d_h-i-s');
        return [
            CreateAction::make(),
            ExcelImportAction::make()
                ->color("primary")
                ->use(StudentImport::class)
                ->sampleFileExcel(
                    url: url('file/TemplateSantri.xls'),
                    sampleButtonLabel: 'Download Sample',
                    customiseActionUsing: fn(Action $action) => $action->color('primary')
                        ->icon('heroicon-m-clipboard')
                        ->requiresConfirmation(),
                ),
            ExportAction::make()->exports([
                ExcelExport::make()->withColumns([
                    Column::make('no')->heading('No')
                        ->formatStateUsing(fn($state, $rowLoop) => $rowLoop->iteration),
                    Column::make('student_number')->heading('Nomor Induk'),
                    Column::make('national_id')->heading('Nomor NIK')
                        ->formatStateUsing(fn($state) => "'" . $state), // menambahkan tanda petik di depan untuk menghindari format scientific
                    Column::make('name')->heading('Nama Lengkap'),
                    Column::make('gender')->heading('Jenis Kelamin'),
                    Column::make('birth_place')->heading('Tempat Lahir'),
                    Column::make('birth_date')->heading('Tanggal Lahir')
                        ->formatStateUsing(fn($state) => $state?->format('d-M-Y')),
                    Column::make('religion')->heading('Agama'),
                    Column::make('child_number')->heading('Anak Ke'),
                    Column::make('family_status')->heading('Status Dalam Keluarga'),
                    Column::make('address')->heading('Alamat'),
                    Column::make('school_name')->heading('Asal Sekolah'),
                    Column::make('father_name')->heading('Nama Ayah'),
                    Column::make('mother_name')->heading('Nama Ibu'),
                    Column::make('father_national_id')->heading('NIK Ayah')
                        ->formatStateUsing(fn($state) => "'" . $state),
                    Column::make('mother_national_id')->heading('NIK Ibu')
                        ->formatStateUsing(fn($state) => "'" . $state),
                    Column::make('father_job')->heading('Pekerjaan Ayah'),
                    Column::make('mother_job')->heading('Pekerjaan Ibu'),
                ])
                    ->withFilename($filename)
            ])
        ];
    }
}
