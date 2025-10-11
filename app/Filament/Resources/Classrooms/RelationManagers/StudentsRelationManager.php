<?php

namespace App\Filament\Resources\Classrooms\RelationManagers;

use App\Models\SchoolYear;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'students';
    protected static ?string $title = 'Santri';
    protected static string $itemlabel = 'Santri';
    protected static bool $isLazy = false;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
            ])->defaultSort(function (Builder $query): Builder {
                return $query->orderBy('name');
            })
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->label('Tambah Santri')
                    ->preloadRecordSelect()
                    ->color('success')
                    ->multiple(),
            ])
            ->recordActions([
                DetachAction::make()
                    ->label('Hapus Santri dari Kelas'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
