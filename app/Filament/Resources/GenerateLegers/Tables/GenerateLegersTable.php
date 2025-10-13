<?php

namespace App\Filament\Resources\GenerateLegers\Tables;

use App\Models\Classroom;
use App\Models\GenerateLeger;
use App\Models\Report;
use App\Models\SchoolYear;
use App\Models\Student;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GenerateLegersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('school_year.name')
                    ->label('Tahun Ajaran')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama Kelas')
                    ->searchable(),
                TextColumn::make('level')
                    ->label('Tingkatan'),
                TextColumn::make('hr_teacher.name')
                    ->label('Wali Kelas')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                Action::make('process_ranking')
                    ->label('Proses Peringkat & Leger')
                    ->icon('heroicon-o-calculator')
                    ->action(function (Classroom $record) {
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
                        Notification::make()->title('Peringkat berhasil diproses!')->success()->send();
                    }),
                ViewAction::make('leger'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
