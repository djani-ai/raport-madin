<?php

namespace App\Services;

use App\Models\Classroom; // Gunakan model Classroom sebagai parameter
use App\Models\GenerateLeger;
use App\Models\Report;
use App\Models\Student;

class RankingService
{
    public function processForClassroom(GenerateLeger $record): bool
    {
        $schoolYearId = $record->school_year_id;
        $studentsWithScores = Student::query()
            ->whereHas('classrooms', function ($query) use ($record) {
                $query->where('classrooms.id', $record->id);
            })
            ->withSum(['values' => function ($query) use ($schoolYearId) {
                $query->where('school_year_id', $schoolYearId);
            }], 'value')
            ->withCount(['values' => function ($query) use ($schoolYearId) {
                $query->where('school_year_id', $schoolYearId);
            }])
            ->orderByDesc('values_sum_value')
            ->get();
        $rank = 0;
        $lastScore = -1;
        $rankedData = [];
        foreach ($studentsWithScores as $key => $student) {
            $currentScore = $student->values_sum_value ?? 0;
            $scoresCount = $student->values_count ?? 0;
            $averageScore = $scoresCount > 0 ? ($currentScore / $scoresCount) : 0;
            if ($currentScore != $lastScore) {
                $rank = $key + 1;
            }
            $rankedData[] = [
                'school_year_id' => $schoolYearId,
                'classroom_id'   => $record->id,
                'student_id'     => $student->id,
                'total_score'    => $currentScore,
                'average_score'  => $averageScore,
                'rank'           => $rank,
            ];
            $lastScore = $currentScore;
        }
        Report::upsert(
            $rankedData,
            ['school_year_id', 'classroom_id', 'student_id'],
            ['total_score', 'average_score', 'rank']
        );

        return true;
    }
}
