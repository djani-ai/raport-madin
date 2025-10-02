<?php

namespace App\Filament\Resources\Students;

use App\Filament\Resources\Students\Pages\ManageStudents;
use App\Models\Student;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Student';
    protected static string | UnitEnum | null $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Students';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('student_number')
                    ->required(),
                TextInput::make('national_id'),
                TextInput::make('name')
                    ->required(),
                Select::make('gender')
                    ->options(['L' => 'L', 'P' => 'P'])
                    ->required(),
                TextInput::make('birth_place'),
                DatePicker::make('birth_date'),
                TextInput::make('religion'),
                TextInput::make('child_number')
                    ->numeric(),
                TextInput::make('family_status'),
                Textarea::make('address')
                    ->columnSpanFull(),
                TextInput::make('school_name'),
                TextInput::make('father_name'),
                TextInput::make('mother_name'),
                TextInput::make('father_national_id'),
                TextInput::make('mother_national_id'),
                TextInput::make('father_job'),
                TextInput::make('mother_job'),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('student_number'),
                TextEntry::make('national_id'),
                TextEntry::make('name'),
                TextEntry::make('gender'),
                TextEntry::make('birth_place'),
                TextEntry::make('birth_date')
                    ->date(),
                TextEntry::make('religion'),
                TextEntry::make('child_number')
                    ->numeric(),
                TextEntry::make('family_status'),
                TextEntry::make('school_name'),
                TextEntry::make('father_name'),
                TextEntry::make('mother_name'),
                TextEntry::make('father_national_id'),
                TextEntry::make('mother_national_id'),
                TextEntry::make('father_job'),
                TextEntry::make('mother_job'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Student')
            ->columns([
                TextColumn::make('student_number')
                    ->searchable(),
                TextColumn::make('national_id')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('gender'),
                TextColumn::make('birth_place')
                    ->searchable(),
                TextColumn::make('birth_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('religion')
                    ->searchable(),
                TextColumn::make('child_number')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('family_status')
                    ->searchable(),
                TextColumn::make('school_name')
                    ->searchable(),
                TextColumn::make('father_name')
                    ->searchable(),
                TextColumn::make('mother_name')
                    ->searchable(),
                TextColumn::make('father_national_id')
                    ->searchable(),
                TextColumn::make('mother_national_id')
                    ->searchable(),
                TextColumn::make('father_job')
                    ->searchable(),
                TextColumn::make('mother_job')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
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
            'index' => ManageStudents::route('/'),
        ];
    }
}
