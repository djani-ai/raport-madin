<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Report;
use App\Models\Subject;
use App\Models\Value;
use Spatie\LaravelPdf\Enums\Orientation;
use Spatie\LaravelPdf\Enums\Unit;
use Spatie\LaravelPdf\Facades\Pdf;

class LegerPdfController extends Controller
{
    public function cetakLeger(Classroom $record)
    {
        $top = 0;
        $right = 0;
        $bottom = 0;
        $left = 0;

        $record->load(['students', 'hr_teacher', 'school_year']);
        $studentIds = $record->students->pluck('id');
        $subjects = Subject::whereHas('schedules', function ($query) use ($record) {
            $query->where('classroom_id', $record->id)
                ->where('school_year_id', $record->school_year_id);
        })->orderBy('name', 'asc')->get();
        $grades = [];
        if ($studentIds->isNotEmpty()) {
            $values = Value::whereIn('student_id', $studentIds)
                ->whereHas('schedule', function ($query) use ($record) {
                    $query->where('classroom_id', $record->id)
                        ->where('school_year_id', $record->school_year_id);
                })
                ->with('schedule:id,subject_id')
                ->get();
            foreach ($values as $value) {
                if ($value->schedule && $value->schedule->subject_id) {
                    $grades[$value->student_id][$value->schedule->subject_id] = $value->value;
                }
            }
        }
        $studentReports = [];
        if ($studentIds->isNotEmpty()) {
            $reports = Report::whereIn('student_id', $studentIds)
                ->where('classroom_id', $record->id)
                ->where('school_year_id', $record->school_year_id)
                ->get()
                ->keyBy('student_id');
            foreach ($record->students as $student) {
                $studentReports[$student->id] = [
                    'total_score' => $reports[$student->id]->total_score ?? 0,
                    'average' => $reports[$student->id]->average_score ?? 0,
                    'rank' => $reports[$student->id]->rank ?? '-',
                ];
            }
        }
        $fileName = 'Leger -' . $record->name . '.pdf';
        return Pdf::view('raport.leger', [
            'classroom'      => $record,
            'subjects'       => $subjects,
            'grades'         => $grades,
            'studentReports' => $studentReports,
        ])
            ->paperSize(215.9, 330, 'mm')
            ->inline($fileName)
            ->orientation(Orientation::Landscape)
            ->margins($top, $right, $bottom, $left, Unit::Pixel);
    }
}
