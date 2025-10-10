<?php

namespace App\Filament\Resources\ClassroomStudents;

use App\Filament\Resources\ClassroomStudents\Pages\CreateClassroomStudent;
use App\Filament\Resources\ClassroomStudents\Pages\EditClassroomStudent;
use App\Filament\Resources\ClassroomStudents\Pages\ListClassroomStudents;
use App\Filament\Resources\ClassroomStudents\Schemas\ClassroomStudentForm;
use App\Filament\Resources\ClassroomStudents\Tables\ClassroomStudentsTable;
use App\Models\ClassroomStudent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ClassroomStudentResource extends Resource
{
    protected static ?string $model = ClassroomStudent::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $recordTitleAttribute = 'Cetak Nilai';
    protected static string | UnitEnum | null $navigationGroup = 'Akademik';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Cetak Nilai';
    protected static ?string $label = 'Cetak Nilai';
    protected static ?string $pluralLabel = 'Cetak Nilai';
    protected static ?string $slug = '-print-value';

    public static function form(Schema $schema): Schema
    {
        return ClassroomStudentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClassroomStudentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListClassroomStudents::route('/'),
            // 'create' => CreateClassroomStudent::route('/create'),
            'edit' => EditClassroomStudent::route('/{record}/edit'),
        ];
    }
}
