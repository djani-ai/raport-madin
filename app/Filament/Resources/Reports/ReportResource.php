<?php

namespace App\Filament\Resources\Reports;

use App\Filament\Resources\Reports\Pages\CreateReport;
use App\Filament\Resources\Reports\Pages\ManageReports;
use App\Models\Report;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Report';
    protected static string | UnitEnum | null $navigationGroup = 'Input Reports';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('')
                    ->description('')
                    ->schema([
                        TextInput::make('school_year_id')
                            ->required()
                            ->numeric(),
                        TextInput::make('students_id')
                            ->required()
                            ->numeric(),
                        TextInput::make('class_id')
                            ->required()
                            ->numeric(),
                        TextInput::make('rank')
                            ->numeric(),
                        Textarea::make('guardian_note')
                            ->columnSpanFull(),
                        Textarea::make('head_note')
                            ->columnSpanFull(),
                        Select::make('status_up')
                            ->options(['Naik' => 'Naik', 'Tinggal' => 'Tinggal', 'Lulus' => 'Lulus']),
                        DatePicker::make('print_date'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Report')
            ->columns([
                TextColumn::make('school_year_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('students_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('class_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('rank')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status_up'),
                TextColumn::make('print_date')
                    ->date()
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
            'index' => ManageReports::route('/'),
            'create' => CreateReport::route('/create')
        ];
    }
}
