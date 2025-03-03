<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PatientTypeOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $stats = Patient::query()
            ->selectRaw('type, count(*) as count')
            ->groupBy('type')
            ->get()
            ->keyBy('type')
            ->map(fn ($stat) => $stat->count);

        return [
            Stat::make('Cat', $stats->get('cat', 0)),
            Stat::make('Dog', $stats->get('dog', 0)),
            Stat::make('Rabbit', $stats->get('rabbit', 0)),
        ];
    }
}
