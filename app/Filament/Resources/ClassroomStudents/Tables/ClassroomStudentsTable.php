<?php

namespace App\Filament\Resources\ClassroomStudents\Tables;

use App\Models\ClassroomStudent;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Blade;
use Torgodly\Html2Media\Actions\Html2MediaAction;

class ClassroomStudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('classroom.name'),
                TextColumn::make('students.name')
                    ->sortable()
            ])->paginated(false)
            ->filters([
                SelectFilter::make('class')
                    ->relationship('classroom', 'name', hasEmptyOption: true)
                    ->emptyRelationshipOptionLabel('Pilih Kelas')
                    ->selectablePlaceholder(false)
                    ->default('Pilih Kelas')
            ], layout: FiltersLayout::AboveContent)->deferFilters(false)
            ->recordActions([
                EditAction::make(),
                //Proses LEGGER

                // Action::make('Cetak')
                //     ->label('PDF')
                //     ->color('success')
                //     ->icon('heroicon-s-printer')
                //     ->action(
                //         function (ClassroomStudent $record) {
                //             // $namafile = 'namafile';
                //             // return response()->stream(function () use ($record) {
                //             //     $pdf = Pdf::loadHtml(
                //             //         Blade::render('raport/raport', ['record' => $record])
                //             //     )->setPaper('Folio');
                //             //     echo $pdf->output();
                //             // }, 200, [
                //             //     'Content-Type' => 'application/pdf',
                //             //     'Content-Disposition' => 'inline; filename="' . $namafile . '.pdf"',
                //             // ]);

                //             return view('raport/raport', ['record' => $record]);
                //         }
                //     )->openUrlInNewTab(),
                Action::make('Lihat HTML')
                    ->label('Lihat HTML')
                    ->color('info')
                    ->icon('heroicon-s-eye')
                    ->url(fn(ClassroomStudent $record): string => route('raport.preview', ['record' => $record]))
                    ->openUrlInNewTab(),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
