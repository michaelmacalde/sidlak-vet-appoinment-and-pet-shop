<?php

namespace App\Filament\Resources\Animal\DogResource\Widgets;

use App\Models\Animal\Dog;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\DB;

class DogStatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        $currentMonth = Carbon::now()->startOfMonth();
        $previousMonth = Carbon::now()->subMonth()->startOfMonth();

        // Combine all necessary calculations into a single query
        $dogStats = Dog::query()
            ->select([
                DB::raw('COUNT(*) as total'),
                DB::raw("SUM(CASE WHEN status = 'available' THEN 1 ELSE 0 END) as available"),
                DB::raw("SUM(CASE WHEN status = 'adopted' THEN 1 ELSE 0 END) as adopted"),
                DB::raw("SUM(CASE WHEN status = 'adopted' AND created_at >= '$currentMonth' THEN 1 ELSE 0 END) as current_month_adopted"),
                DB::raw("SUM(CASE WHEN status = 'adopted' AND created_at >= '$previousMonth' AND created_at < '$currentMonth' THEN 1 ELSE 0 END) as previous_month_adopted"),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw("SUM(CASE WHEN status = 'adopted' THEN 1 ELSE 0 END) as monthly_adopted")
            ])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $currentMonthAdoptions = $dogStats->firstWhere('month', $currentMonth->format('Y-m'))->current_month_adopted ?? 0;
        $previousMonthAdoptions = $dogStats->firstWhere('month', $previousMonth->format('Y-m'))->previous_month_adopted ?? 0;

        [$adoptionIncreasePercentage, $direction] = $this->calculatePercentageIncrease($previousMonthAdoptions, $currentMonthAdoptions);

        // Calculate the percentage of adopted dogs based on available dogs
        $percentageAdopted = $this->calculateAdoptedPercentage($dogStats->sum('available'), $dogStats->sum('adopted'));

        // Prepare data for the monthly adoption trend chart
        $adoptedData = $dogStats->pluck('monthly_adopted')->toArray();

        return [
            Stat::make('Total Dogs', $dogStats->sum('total'))->color('primary'),
            Stat::make('Available for adoption', $dogStats->sum('available'))->color('success'),
            Stat::make('Total Dogs Adopted', $dogStats->sum('adopted'))
                ->color('success')
                ->chart($adoptedData)
                ->description($adoptionIncreasePercentage . '% ' . $direction)
                ->descriptionIcon($adoptionIncreasePercentage > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($adoptionIncreasePercentage > 0 ? 'success' : 'danger'),
            Stat::make('Adoption Rate', $percentageAdopted . '%')->color('info'),
        ];
    }

    protected function calculatePercentageIncrease($previous, $current)
    {
        if ($previous == 0) {
            return [$current > 0 ? 100 : 0, $current > 0 ? 'increase' : 'no change'];
        }

        $increase = (($current - $previous) / $previous) * 100;
        $direction = $increase > 0 ? 'increase' : 'decrease';

        return [number_format($increase, 2), $direction];
    }

    protected function calculateAdoptedPercentage($available, $adopted)
    {
        if ($available == 0) {
            return $adopted > 0 ? 100 : 0;
        }

        return number_format(($adopted / $available) * 100, 2);
    }
}
