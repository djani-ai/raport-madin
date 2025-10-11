<?php

namespace App\Filament\Resources\Schedules\RelationManagers;

use App\Models\Schedule;
use App\Models\SchoolYear;
use Filament\Actions\Action;
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
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;

class ValuesRelationManager extends RelationManager
{
    protected static string $relationship = 'values';
    protected static ?string $title = 'Nilai';
    protected static bool $isLazy = false;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([]);
    }

    public function table(Table $table): Table
    {
        $schedule = $this->getOwnerRecord();

        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('student.name')
                    ->label('Santri'),
                TextInputColumn::make('value_lock')
                    ->label('Nilai')
                    ->disabled()
                    ->state(fn($record): ?string => $record->value)
                    ->hidden(fn(): bool => !$this->getOwnerRecord()?->lock_value_status),
                TextInputColumn::make('value')
                    ->label('Nilai')
                    ->hidden(fn(): bool => (bool) $this->getOwnerRecord()?->lock_value_status),
            ])
            ->filters([])
            ->headerActions([
                Action::make('toggleLock')
                    ->label(fn(): string => $schedule?->lock_value_status ? 'Buka Kunci Nilai' : 'Kunci Nilai')
                    ->icon(fn(): string => $schedule?->lock_value_status ? 'heroicon-s-lock-open' : 'heroicon-s-lock-closed')
                    ->color(fn(): string => $schedule?->lock_value_status ? 'success' : 'danger')
                    ->requiresConfirmation()
                    ->modalHeading(fn(): string => $schedule?->lock_value_status ? 'Buka Kunci Nilai?' : 'Kunci Semua Nilai?')
                    ->modalDescription('Setelah aksi ini dijalankan, status nilai akan diubah. Anda dapat mengubahnya kembali nanti.')
                    ->modalSubmitActionLabel(fn(): string => $schedule?->lock_value_status ? 'Ya, Buka Kunci' : 'Ya, Kunci')
                    ->action(function () use ($schedule) {
                        $schedule->lock_value_status = !$schedule->lock_value_status;
                        $schedule->save();
                        Notification::make()
                            ->title('Status Berhasil Diubah')
                            ->success()
                            ->send();
                    }),
            ])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
