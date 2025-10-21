<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Resources\Students\StudentResource;
use App\Imports\StudentImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use EightyNine\ExcelImport\ExcelImportAction;
use pxlrbt\FilamentExcel\Actions\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ManageStudents extends ManageRecords
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        $filename = 'Santri' . '_' . date('Y-m-d_h-i-s');
        return [
            CreateAction::make()
                ->label('Tambah')
                ->color('danger')
                ->icon('heroicon-o-plus'),
            ExcelImportAction::make('import')
                ->color('success')
                ->icon('heroicon-o-cloud-arrow-up')
                ->use(StudentImport::class)
                ->sampleFileExcel(
                    url: url('file/TemplateSantri.xls'),
                    sampleButtonLabel: 'Download Template',
                    customiseActionUsing: fn(Action $action) => $action->color('primary')
                        ->icon('heroicon-m-clipboard'),
                ),
            ExportAction::make()
                ->color('info')
                ->icon('heroicon-o-cloud-arrow-down')
                ->exports([
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
            // ->exporter(StudentExporter::class)
            // ->columnMapping(false)
            // ->formats([ExportFormat::Xlsx])
            // // ->fileName($filename),
            // ->fileName(fn(Export $export) => "Students-{$export->getKey()}.xlsx")
            // ->queue(false),
        ];
    }
}
