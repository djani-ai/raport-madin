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
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
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
                Section::make('Identitas Santri')
                    ->schema([
                        Grid::make()
                            ->columns(6)
                            ->schema([
                                TextInput::make('student_number')
                                    ->label('Nomor Induk')
                                    ->required()
                                    ->columns(1),
                                TextInput::make('national_id')
                                    ->label('NIK')
                                    ->required()
                                    ->columnSpan(2),
                                TextInput::make('name')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->columnSpan(3),
                            ]),
                        Grid::make()
                            ->columns(10)
                            ->schema([
                                Select::make('gender')
                                    ->label('Jenis Kelamin')
                                    ->options(['L' => 'Laki-Laki', 'P' => 'Perempuan'])
                                    ->required()
                                    ->columnspan(2),
                                TextInput::make('birth_place')
                                    ->label('Tempat Lahir')
                                    ->required()
                                    ->columnspan(3),
                                DatePicker::make('birth_date')
                                    ->label('Tanggal Lahir')
                                    ->required()
                                    ->columnspan(2),
                                Select::make('religion')
                                    ->label('Agama')
                                    ->required()
                                    ->options([
                                        'Islam' => 'Islam',
                                        'Kristen' => 'Kristen',
                                        'Hindu' => 'Hindu',
                                        'Buddha' => 'Buddha',
                                        'Konghucu' => 'Konghucu',
                                    ])
                                    ->columnSpan(3)
                            ]),
                        Grid::make()
                            ->columns(10)
                            ->schema([
                                TextInput::make('child_number')
                                    ->label('Anak Ke')
                                    ->numeric()
                                    ->columnSpan(2),
                                Select::make('family_status')
                                    ->label('Status')
                                    ->required()
                                    ->options([
                                        'Anak Kandung' => 'Anak Kandung',
                                        'Anak Tiri' => 'Anak Tiri',
                                        'Anak Angkat' => 'Anak Angkat',
                                    ])
                                    ->columnSpan(3),
                                TextInput::make('school_name')
                                    ->label('Asal Sekolah')
                                    ->columnSpan(5),
                                Textarea::make('address')
                                    ->label('Alamat')
                                    ->columnSpanFull()
                                    ->rows(3),
                            ]),
                    ])
                    ->columnSpanFull(),
                Section::make('Data Orang Tua/Wali')
                    ->schema([
                        Grid::make()
                            ->columns(2)
                            ->schema([
                                TextInput::make('father_name')
                                    ->label('Nama Ayah')
                                    ->required(),
                                TextInput::make('mother_name')
                                    ->label('Nama Ibu')
                                    ->required(),
                                TextInput::make('father_national_id')
                                    ->label('NIK Ayah'),
                                TextInput::make('mother_national_id')
                                    ->label('NIK Ibu'),
                                TextInput::make('father_job')
                                    ->label('Pekerjaan Ayah'),
                                TextInput::make('mother_job')
                                    ->label('Pekerjaan Ibu'),
                            ]),
                    ])->columnSpanFull(),
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
