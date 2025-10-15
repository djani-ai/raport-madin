<?php

namespace App\Filament\Resources\GenerateLegers\Tables;

use App\Models\Classroom;
use App\Models\GenerateLeger;
use App\Models\Report;
use App\Models\Student;
use App\Services\RankingService;
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
                TextColumn::make('name')
                    ->label('Kelas')
                    ->searchable(),
                TextColumn::make('level')
                    ->label('Tingkatan'),
                TextColumn::make('hr_teacher.name')
                    ->label('Wali Kelas')
                    ->sortable(),
                TextColumn::make('school_year.name')
                    ->label('Tahun Ajaran')
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
                Action::make('process_ranking')
                    ->label('Proses Peringkat & Leger')
                    ->icon('heroicon-o-calculator')
                    ->action(function (GenerateLeger $record, RankingService $rankingService) {
                        $success = $rankingService->processForClassroom($record);
                        if ($success) {
                            Notification::make()
                                ->title('Peringkat berhasil diproses!')
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('Gagal memproses peringkat')
                                ->body('Tidak ada data nilai yang bisa diproses untuk kelas ini.')
                                ->danger()
                                ->send();
                        }
                    }),
                // ViewAction::make(),
                // EditAction::make(),
                // Action::make('Lihat HTML')
                //     ->label('Lihat HTML')
                //     ->color('info')
                //     ->icon('heroicon-s-eye')
                //     ->url(fn(GenerateLeger $record): string => route('leger.preview', ['record' => $record]))
                //     ->openUrlInNewTab(),
                Action::make('cetak')
                    ->requiresConfirmation()
                    ->label('PDF')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    // ->modalHeading('Download PDF')
                    // ->modalDescription('Pastikan Leger Sudah di Generate/Proses Sebelumnya agar nilai tidak kosong')
                    // ->modalSubmitActionLabel('Download')
                    ->url(fn(GenerateLeger $record): string => route('leger.cetak', $record))

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
