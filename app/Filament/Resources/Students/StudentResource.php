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
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    protected static ?string $recordTitleAttribute = 'Santri';
    protected static string | UnitEnum | null $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Santri';
    protected static ?string $label = 'Santri';
    protected static ?string $pluralLabel = 'Santri';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('student_number')
                    ->required()
                    ->unique(ignoreRecord: true),
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


    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Santri')
            ->columns([
                TextColumn::make('student_number')
                    ->label('Nomor Induk')
                    ->searchable(),
                TextColumn::make('national_id')
                    ->label('NIK')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable(),
                TextColumn::make('gender')
                    ->label('Jenis Kelamin'),
                TextColumn::make('birth_place')
                    ->label('Tempat Lahir'),
                TextColumn::make('birth_date')
                    ->label('Tanggal Lahir')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('religion')
                    ->label('Agama')
                    ->searchable(),
                TextColumn::make('child_number')
                    ->label('Anak Ke')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('family_status')
                    ->label('Status Dalam Keluarga')
                    ->searchable(),
                TextColumn::make('school_name')
                    ->label('Asal Sekolah')
                    ->searchable(),
                TextColumn::make('father_name')
                    ->label('Nama Ayah')
                    ->searchable(),
                TextColumn::make('mother_name')
                    ->label('Nama Ibu')
                    ->searchable(),
                TextColumn::make('father_national_id')
                    ->label('NIK Ayah')
                    ->searchable(),
                TextColumn::make('mother_national_id')
                    ->label('NIK Ibu')
                    ->searchable(),
                TextColumn::make('father_job')
                    ->label('Pekerjaan Ayah')
                    ->searchable(),
                TextColumn::make('mother_job')
                    ->label('Pekerjaan Ibu')
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
