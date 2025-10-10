<?php

namespace App\Filament\Resources\GenerateLegers\Tables;

use App\Models\Classroom;
use App\Models\GenerateLeger;
use App\Models\Report;
use App\Models\SchoolYear;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GenerateLegersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('level'),
                TextColumn::make('hr_teacher_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('school_year_id')
                    ->numeric()
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
            ->filters([
                //
            ])
            ->recordActions([
                // EditAction::make(),
                Action::make('process_ranking')
                    ->label('Proses Peringkat & Leger')
                    ->icon('heroicon-o-calculator')
                    ->action(function (Classroom $record) {
                        // AMBIL SEMUA LOGIKA DARI JAWABAN SEBELUMNYA
                        // $schoolYearId = SchoolYear::where('is_active', true)->first('id');
                        $schoolYearId = $record->school_year_id;

                        // dd($schoolYearId);
                        // 1. Ambil data mentah (Sama seperti sebelumnya)
                        $classroom = $record->load(['students.values' => function ($q) use ($schoolYearId) {
                            $q->where('school_year_id', $schoolYearId);
                        }]);

                        // 2. Kalkulasi & Agregasi (Sama seperti sebelumnya)
                        $reportData = collect();
                        foreach ($classroom->students as $student) {
                            $reportData->push([
                                'student_id' => $student->id,
                                'total_score' => $student->values->sum('value'),
                            ]);
                        }
                        // 3. Urutkan & Beri Peringkat (Sama seperti sebelumnya)
                        $sortedData = $reportData->sortByDesc('total_score');
                        $rank = 0;
                        $lastScore = -1;
                        $rankedData = $sortedData->map(function ($item, $key) use (&$rank, &$lastScore) {
                            if ($item['total_score'] != $lastScore) {
                                $rank = $key + 1;
                            }
                            $item['rank'] = $rank;
                            $lastScore = $item['total_score'];
                            return $item;
                        });

                        // 4. SIMPAN KE DATABASE
                        foreach ($rankedData as $data) {
                            Report::updateOrCreate(
                                [
                                    'school_year_id' => $schoolYearId,
                                    'classroom_id' => $record->id,
                                    'student_id' => $data['student_id'],
                                ],
                                [
                                    'total_score' => $data['total_score'],
                                    'rank' => $data['rank'],
                                ]
                            );
                        }

                        Notification::make()->title('Peringkat berhasil diproses!')->success()->send();
                    })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
