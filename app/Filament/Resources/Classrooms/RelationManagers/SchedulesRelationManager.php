<?php

namespace App\Filament\Resources\Classrooms\RelationManagers;

use App\Models\SchoolYear;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Zvizvi\RelationManagerRepeater\Tables\RelationManagerRepeaterAction;

class SchedulesRelationManager extends RelationManager
{
    protected static string $relationship = 'schedules';
    protected static ?string $title = 'Mata Pelajaran';
    protected static bool $isLazy = false;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([]);
    }

    public function table(Table $table): Table
    {
        return $table

            ->recordTitle('Data Jadwal')
            ->columns([
                TextColumn::make('subject.name')
                    ->label('Mata Pelajaran'),
                TextColumn::make('teacher.name')
                    ->label('Ustadz/Ustadzah'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                RelationManagerRepeaterAction::make()
                    ->modalWidth('5xl')
                    ->label('Edit Jadwal')
                    ->configureRepeater(function (Repeater $repeater) {
                        return $repeater
                            ->schema([
                                Select::make('subject_id')
                                    ->relationship('subject', 'name')
                                    ->hiddenLabel()
                                    ->distinct()
                                    ->validationMessages([
                                        'distinct' => 'Mata Pelajaran Sudah Sudah Ada.',
                                    ]),
                                Select::make('teacher_id')
                                    ->relationship('teacher', 'name')
                                    ->required()
                                    ->hiddenLabel(),
                                Hidden::make('school_year_id')
                                    ->label('Tahun Ajaran')
                                    ->default(function () {
                                        return SchoolYear::where('is_active', true)->first()->id;
                                    })
                                    ->required(),
                            ])
                            ->columns(2);
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
