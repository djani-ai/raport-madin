<?php

namespace App\Http\Controllers;

// Sesuaikan namespace model Anda
use App\Models\Classroom;
use App\Models\GenerateLeger;
use App\Models\Report;
use App\Models\Subject;
use App\Models\Value;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GenerateLegerController extends Controller
{
    public function generateLeger(Classroom $record): View
    {
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
        return view('raport.leger', [
            'classroom'      => $record,
            'subjects'       => $subjects,
            'grades'         => $grades,
            'studentReports' => $studentReports,
        ]);
    }
}
