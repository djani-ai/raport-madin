<?php

namespace App\Filament\Resources\Classrooms;

use App\Filament\Resources\Classrooms\Pages\ManageClassrooms;
use App\Models\Classroom;
use App\Models\SchoolYear;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class ClassroomResource extends Resource
{
    protected static ?string $model = Classroom::class;

    protected static ?string $recordTitleAttribute = 'Kelas';
    protected static ?string $label = 'Kelas';
    protected static ?string $pluralLabel = 'Kelas';
    protected static ?int $navigationSort = 2;
    protected static string | UnitEnum | null $navigationGroup = 'Master Data';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Kelas')
                    ->required(),
                Select::make('level')
                    ->label('Tingkatan')
                    ->options(['Awwaliyah' => 'Awwaliyah', 'Wustha' => 'Wustha', 'Ulya' => 'Ulya'])
                    ->required(),
                Select::make('hr_teacher_id')
                    ->label('Wali Kelas')
                    ->relationship('hr_teacher', 'name'),
                Hidden::make('school_year_id')
                    ->label('Tahun Ajaran')
                    ->default(function () {
                        return SchoolYear::where('is_active', true)->first()->id;
                    })
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Classroom')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Nama Kelas'),
                TextColumn::make('level')
                    ->label('Tingkatan'),
                TextColumn::make('hr_teacher.name')
                    ->label('Wali Kelas')
                    ->sortable(),
                TextColumn::make('school_year.name')
                    ->label('Tahun Ajaran')
                    ->sortable(),
                TextColumn::make('school_year.semester')
                    ->label('Semester')
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
            'index' => ManageClassrooms::route('/'),
        ];
    }
}
