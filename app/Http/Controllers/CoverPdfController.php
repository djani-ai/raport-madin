<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Value;
use Spatie\LaravelPdf\Enums\Unit;
use Spatie\LaravelPdf\Facades\Pdf;

class CoverPdfController extends Controller
{
    public function cetakCover(Report $report)
    {

        $top = 0;
        $right = 0;
        $bottom = 0;
        $left = 30;
        $report->load(['student', 'classroom', 'schoolYear']);
        $fileName = 'Cover - ' . $report->student->name . '.pdf';
        return Pdf::view('raport.cover', [
            'report' => $report,
            'filename' => $fileName,
        ])
            ->paperSize(215.9, 330, 'mm')
            ->inline($fileName)
            ->margins($top, $right, $bottom, $left, Unit::Pixel);
    }
}
