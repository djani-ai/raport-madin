<?php

namespace App\Filament\Resources\Schedules\RelationManagers;

use App\Models\SchoolYear;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;

class ValuesRelationManager extends RelationManager
{
    protected static string $relationship = 'values';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('student_id')
                    ->relationship('student', 'name')
                    ->required(),
                TextInput::make('value')
                    ->label('nilai')
                    ->default('0'),
                Hidden::make('school_year_id')
                    ->label('Tahun Ajaran')
                    ->default(function () {
                        return SchoolYear::where('is_active', true)->first()->id;
                    })
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitle('Nilai')
            ->recordTitleAttribute('id')
            ->modelLabel('Nilai')
            ->pluralModelLabel('Nilai')
            ->columns([
                TextColumn::make('student.name')
                    ->label('Santri'),
                TextInputColumn::make('value')
                    ->label('Nilai')
                    ->disabled(),
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->recordActions([])
            ->toolbarActions([
                // BulkActionGroup::make([

            ]);
    }
}
