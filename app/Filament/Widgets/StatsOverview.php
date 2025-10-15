<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\Teacher;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $santri = Student::count();
        $guru = Teacher::count();
        return [
            Stat::make('Santri', $santri)
                ->description('Total Santri')
                ->color('success')
                ->chart([2, 3, 5, 10, 4, 17])
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Guru', $guru)
                ->description('Total Ustadz - Ustadzah')
                ->color('success')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([2, 3, 5, 10, 4, 17]),
        ];
    }
}
