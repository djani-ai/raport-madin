<?php

namespace App\Filament\Resources\SubjectGrades;

use App\Filament\Resources\SubjectGrades\Pages\ManageSubjectGrades;
use App\Models\SubjectGrade;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class SubjectGradeResource extends Resource
{
    protected static ?string $model = SubjectGrade::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'SubjectGrade';
    protected static string | UnitEnum | null $navigationGroup = 'Master Data';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('students_id')
                    ->required()
                    ->numeric(),
                TextInput::make('schedule_of_subjects_id')
                    ->required()
                    ->numeric(),
                TextInput::make('school_year_id')
                    ->required()
                    ->numeric(),
                TextInput::make('grade')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('SubjectGrade')
            ->columns([
                TextColumn::make('students_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('schedule_of_subjects_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('school_year_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('grade')
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
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageSubjectGrades::route('/'),
        ];
    }
}
