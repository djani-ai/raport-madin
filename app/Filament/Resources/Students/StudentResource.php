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
                    ->label('Nomor Induk')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('national_id')
                    ->label('NIK')
                    ->required(),
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required(),
                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options(['L' => 'L', 'P' => 'P'])
                    ->required(),
                TextInput::make('birth_place')
                    ->label('Tempat Lahir')
                    ->required(),
                DatePicker::make('birth_date')
                    ->label('Tanggal Lahir')
                    ->required(),
                TextInput::make('religion')
                    ->label('Agama')
                    ->required(),
                TextInput::make('child_number')
                    ->label('Anak Ke')
                    ->numeric(),
                Select::make('family_status')
                    ->label('Status Dalam Keluarga')
                    ->required()
                    ->options([
                        'Anak Kandung' => 'Anak Kandung',
                        'Anak Tiri' => 'Anak Tiri',
                        'Anak Angkat' => 'Anak Angkat',
                    ]),
                Textarea::make('address')
                    ->columnSpanFull(),
                TextInput::make('school_name')
                    ->label('Asal Sekolah'),
                TextInput::make('father_name')
                    ->label('Nama Ayah'),
                TextInput::make('mother_name')
                    ->label('Nama Ibu'),
                TextInput::make('father_national_id')
                    ->label('NIK Ayah'),
                TextInput::make('mother_national_id')
                    ->label('NIK Ibu'),
                TextInput::make('father_job')
                    ->label('Pekerjaan Ayah'),
                TextInput::make('mother_job')
                    ->label('Pekerjaan Ibu'),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            // ->recordTitleAttribute('Santri')
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
