<?php

namespace App\Filament\Resources\Values\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ValuesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('school_year_id')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('classroom.name')

                    // ->numeric()
                    ->sortable(),
                // TextColumn::make('student_id')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('subject.name')
                    ->numeric()
                    ->sortable(),
                // TextColumn::make('teacher_id')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('value')
                //     ->numeric()
                //     ->sortable(),
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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
