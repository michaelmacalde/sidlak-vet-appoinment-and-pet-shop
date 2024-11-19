<?php

namespace App\Filament\Resources\Animal\AdoptionResource\Widgets;

use App\Models\Adoption\Adoption;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\DB;

class AdoptionStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Combine count queries into a single query
        $adoptionCounts = Adoption::select([
            DB::raw('COUNT(*) as total'),
            DB::raw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending"),
            DB::raw("SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) as approved"),
            DB::raw("SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END) as rejected")
        ])->first();

        // Fetch trend data for the past year in a single query
        $adoptionData = Trend::model(Adoption::class)
            ->between(
                start: now()->subYear(),
                end: now(),
            )
            ->perMonth()
            ->count()
            ->map(fn (TrendValue $value) => $value->aggregate)
            ->toArray();

        return [
            Stat::make('Total adoption requests', $adoptionCounts->total)
                ->color('success')
                ->chart($adoptionData),
            Stat::make('Pending', $adoptionCounts->pending)
                ->color('warning'),
            Stat::make('Approved', $adoptionCounts->approved)
                ->color('success'),
            Stat::make('Rejected', $adoptionCounts->rejected)
                ->color('danger'),
        ];
    }
}
