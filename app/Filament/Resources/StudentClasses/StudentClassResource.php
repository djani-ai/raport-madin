<?php

namespace App\Filament\Resources\StudentClasses;

use App\Filament\Resources\StudentClasses\Pages\ManageStudentClasses;
use App\Models\StudentClass;
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

class StudentClassResource extends Resource
{
    protected static ?string $model = StudentClass::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'StudentClass';
    protected static string | UnitEnum | null $navigationGroup = 'Master Data';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('school_year_id')
                    ->required()
                    ->numeric(),
                TextInput::make('class_id')
                    ->required()
                    ->numeric(),
                TextInput::make('students_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('StudentClass')
            ->columns([
                TextColumn::make('school_year_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('class_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('students_id')
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
            'index' => ManageStudentClasses::route('/'),
        ];
    }
}
