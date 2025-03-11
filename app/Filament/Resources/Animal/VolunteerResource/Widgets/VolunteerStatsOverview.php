<?php

namespace App\Filament\Resources\Animal\VolunteerResource\Widgets;

use App\Models\Volunteer\Volunteer;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\DB;

class VolunteerStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $currentMonth = Carbon::now()->startOfMonth();
        $previousMonth = Carbon::now()->subMonth()->startOfMonth();

        // Combine all necessary calculations into a single query
        $volunteerStats = Volunteer::query()
            ->select([
                DB::raw('COUNT(*) as total'),
                DB::raw("SUM(CASE WHEN volunteer_status_type = 'pending' THEN 1 ELSE 0 END) as pending"),
                DB::raw("SUM(CASE WHEN volunteer_status_type = 'approved' THEN 1 ELSE 0 END) as approved"),
                DB::raw("SUM(CASE WHEN volunteer_status_type = 'rejected' THEN 1 ELSE 0 END) as rejected"),
                DB::raw("SUM(CASE WHEN volunteer_status_type = 'approved' AND created_at >= '$currentMonth' THEN 1 ELSE 0 END) as current_month_approved"),
                DB::raw("SUM(CASE WHEN volunteer_status_type = 'approved' AND created_at >= '$previousMonth' AND created_at < '$currentMonth' THEN 1 ELSE 0 END) as previous_month_approved")
            ])
            ->first();

        $currentMonthApproved = $volunteerStats->current_month_approved;
        $previousMonthApproved = $volunteerStats->previous_month_approved;

        [$approvalIncreasePercentage, $direction] = $this->calculatePercentageIncrease($previousMonthApproved, $currentMonthApproved);

        // Fetch trend data for the past year in a single query
        $volunteerData = Trend::model(Volunteer::class)
            ->between(
                start: now()->subYear(),
                end: now(),
            )
            ->perMonth()
            ->count()
            ->map(fn (TrendValue $value) => $value->aggregate)
            ->toArray();

        return [
            Stat::make('Total Volunteers', $volunteerStats->total)
                ->color('success')
                ->chart($volunteerData)
                ->description($approvalIncreasePercentage . '% ' . $direction),
            Stat::make('Pending Requests', $volunteerStats->pending ?? 0)
                ->color('primary')
                ->description('waiting for approval'),
            Stat::make('Approved Requests', $volunteerStats->approved ?? 0)
                ->color('success')
                ->description('Volunteers approved for the past month'),
            Stat::make('Rejected', $volunteerStats->rejected ?? 0)
                ->color('danger'),
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
}
