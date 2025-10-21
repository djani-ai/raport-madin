<?php

namespace App\Filament\Exports;

use App\Models\Student;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class StudentExporter extends Exporter
{
    protected static ?string $model = Student::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('student_number'),
            ExportColumn::make('national_id'),
            ExportColumn::make('name'),
            ExportColumn::make('gender'),
            ExportColumn::make('birth_place'),
            ExportColumn::make('birth_date'),
            ExportColumn::make('religion'),
            ExportColumn::make('child_number'),
            ExportColumn::make('family_status'),
            ExportColumn::make('address'),
            ExportColumn::make('school_name'),
            ExportColumn::make('father_name'),
            ExportColumn::make('mother_name'),
            ExportColumn::make('father_national_id'),
            ExportColumn::make('mother_national_id'),
            ExportColumn::make('father_job'),
            ExportColumn::make('mother_job'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your student export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
