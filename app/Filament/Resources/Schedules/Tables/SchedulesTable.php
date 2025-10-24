<?php

namespace App\Filament\Resources\Schedules\Tables;

use App\Filament\Exports\SchedulesTemplateExport; // INI BARIS YANG DIPERBAIKI
use App\Imports\ScheduleValuesImport; // Importer baru kita
use App\Models\Schedule;
use App\Models\Value;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\ListRecords; // Penting untuk mendapatkan query
use Maatwebsite\Excel\Facades\Excel; // TAMBAHKAN INI

class SchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('school_year.name')
                    ->label('Tahun Ajaran')
                    ->sortable(),
                TextColumn::make('classroom.name')
                    ->label('Kelas')
                    ->sortable(),
                TextColumn::make('subject.name')
                    ->label('Mata Pelajaran')
                    ->sortable(),
                TextColumn::make('teacher.name')
                    ->label('Ustadz / Ustadzah')
                    ->sortable(),
                IconColumn::make('lock_value_status')
                    ->label('Status Nilai')
                    ->boolean()
                    ->trueIcon('heroicon-s-lock-closed')
                    ->falseIcon('heroicon-s-lock-open')
                    ->trueColor('info')
                    ->falseColor('warning'),
            ])
            ->filters([
                SelectFilter::make('class')
                    ->relationship('classroom', 'name', hasEmptyOption: true)
                    ->emptyRelationshipOptionLabel('Pilih Kelas')
                    ->selectablePlaceholder(false)
                    ->default('Pilih Kelas')
                    ->label('Kelas'),
            ], layout: FiltersLayout::AboveContent)->deferFilters(false)

            ->recordActions([
                ViewAction::make()
                    ->icon('heroicon-o-document-chart-bar')
                    ->label('Input Nilai')
                    ->color('success'),
            ])
            ->headerActions([
                // AKSI 1: DOWNLOAD TEMPLATE MASSAL (DINAMIS) - DIRUBAH KE EXCEL
                Action::make('download_master_template')
                    ->label('Download Template Massal')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('secondary')
                    ->action(function (ListRecords $livewire) {

                        // Ambil query jadwal yang saat ini terfilter di tabel
                        $schedulesQuery = $livewire->getFilteredTableQuery();

                        // Eager load relasi yang dibutuhkan
                        $schedules = $schedulesQuery->with(['classroom.students', 'subject'])->get();

                        if ($schedules->isEmpty()) {
                            Notification::make()
                                ->title('Tidak Ada Data')
                                ->warning()
                                ->body('Silakan filter berdasarkan kelas terlebih dahulu untuk mengunduh template.')
                                ->send();
                            return;
                        }

                        // UBAH NAMA FILE KE .xlsx
                        $filename = "template-massal-nilai-" . now()->format('Y-m-d') . ".xlsx";

                        // --- LOGIKA BARU UNTUK EXCEL ---
                        $data = [];
                        // Header
                        $data[] = ['school_year_id', 'classroom_id', 'schedule_id', 'student_id', 'kelas', 'mata_pelajaran', 'nama_siswa', 'nilai']; // TAMBAHKAN 'school_year_id'

                        // Ambil semua nilai yang ada untuk jadwal & siswa ini
                        $scheduleIds = $schedules->pluck('id');
                        $existingValues = Value::whereIn('schedule_id', $scheduleIds)
                            ->get()
                            ->keyBy(fn($val) => $val->schedule_id . '-' . $val->student_id);

                        foreach ($schedules as $schedule) {
                            // Pastikan relasi ada
                            if (!$schedule->classroom || !$schedule->subject) continue;

                            $students = $schedule->classroom->students;
                            if ($students->isEmpty()) continue; // Lewati jika kelas kosong

                            foreach ($students as $student) {
                                $key = $schedule->id . '-' . $student->id;
                                $value = $existingValues->get($key)?->value ?? ''; // Ambil nilai jika ada

                                // Tambahkan data sebagai array
                                $data[] = [
                                    'school_year_id' => $schedule->school_year_id,
                                    'classroom_id'   => $schedule->classroom_id,
                                    'schedule_id'    => $schedule->id,
                                    'student_id'     => $student->id,
                                    'kelas'          => $schedule->classroom->name,
                                    'mata_pelajaran' => $schedule->subject->name,
                                    'nama_siswa'     => $student->name,
                                    'nilai'          => $value
                                ];
                            }
                        }

                        // Gunakan Maatwebsite/Excel untuk membuat dan mengunduh file
                        return Excel::download(new SchedulesTemplateExport($data), $filename);
                        // --- AKHIR LOGIKA BARU ---
                    }),

                // AKSI 2: IMPORT MASSAL (DENGAN LOGIKA BARU)
                ExcelImportAction::make('import_massal')
                    ->label('Import Massal Nilai')
                    ->icon('heroicon-o-cloud-arrow-up')
                    ->color('primary')
                    // Gunakan kelas Importer baru yang akan kita buat
                    ->use(ScheduleValuesImport::class)
                    // KITA HAPUS ->withData() karena schedule_id sudah ada di file
                    ->after(function () {
                        Notification::make()
                            ->title('Berhasil mengimpor nilai massal')
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                // ...
            ]);
    }
}
