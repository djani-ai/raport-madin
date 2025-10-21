<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Value;
use Spatie\LaravelPdf\Enums\Unit;
use Spatie\LaravelPdf\Facades\Pdf;

class PdfController extends Controller
{
    public function cetakRaport(Report $report)
    {
        $top = 0;
        $right = 30;
        $bottom = 10;
        $left = 10;
        $report->load(['student', 'classroom', 'schoolYear']);
        $values = Value::where('student_id', $report->student_id)
            ->where('school_year_id', $report->school_year_id)
            ->with('schedule.subject')
            ->get();
        $fileName = 'Raport - ' . $report->student->name . '.pdf';
        return Pdf::view('raport.pdf', [
            'report' => $report,
            'values' => $values
        ])
            ->paperSize(215.9, 330, 'mm')
            ->inline($fileName)
            ->margins($top, $right, $bottom, $left, Unit::Pixel);
    }
    public function cetakBiodata(Report $report)
    {
        $top = 10;
        $right = 30;
        $bottom = 10;
        $left = 30;
        $report->load(['student', 'classroom', 'schoolYear']);
        $fileName = 'Biodata - ' . $report->student->name . '.pdf';
        return Pdf::view('raport.biodata', [
            'record' => $report,
        ])
            ->paperSize(215.9, 330, 'mm')
            ->inline($fileName)
            ->margins($top, $right, $bottom, $left, Unit::Pixel);
    }
    public function cetakBiodata2(Report $report)
    {
        $top = 10;
        $right = 30;
        $bottom = 10;
        $left = 30;
        $report->load(['student', 'classroom', 'schoolYear']);
        $fileName = 'Biodata - ' . $report->student->name . '.pdf';
        return Pdf::view('raport.biodata2', [
            'record' => $report,
        ])
            ->paperSize(215.9, 330, 'mm')
            ->inline($fileName)
            ->margins($top, $right, $bottom, $left, Unit::Pixel);
    }
}
