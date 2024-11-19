<?php

namespace App\Filament\Widgets;

use App\Models\Adoption\Adoption;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RequisitionsChart extends ChartWidget
{
    protected static ?string $heading = 'Requisitions Overview';

    protected static ?int $sort = 3;

    // Refresh interval in seconds (optional)
    protected static ?string $pollingInterval = '30s';

    // Maximum number of months to show
    protected int $monthsToShow = 12;

    protected function getData(): array
    {
        $data = $this->getRequisitionsPerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'Adoptions created',
                    'data' => $data['counts'],
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                    'fill' => false,
                    'tension' => 0.1,
                ],
            ],
            'labels' => $data['labels'],
        ];
    }

    protected function getRequisitionsPerMonth(): array
    {
        $startDate = Carbon::now()->subMonths($this->monthsToShow - 1)->startOfMonth();

        $requisitions = Adoption::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', $startDate)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Create arrays for all months, even if there's no data
        $counts = [];
        $labels = [];

        for ($i = 0; $i < $this->monthsToShow; $i++) {
            $currentDate = Carbon::now()->subMonths($this->monthsToShow - 1 - $i);
            $monthKey = $currentDate->format('Y-m');
            $monthLabel = $currentDate->format('M');

            $count = $requisitions->firstWhere('month', $monthKey)?->count ?? 0;

            $counts[] = $count;
            $labels[] = $monthLabel;
        }

        return [
            'counts' => $counts,
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    // Optional: Add filters for different time ranges
    protected function getFilters(): ?array
    {
        return [
            'last_6_months' => 'Last 6 months',
            'last_12_months' => 'Last 12 months',
            'last_24_months' => 'Last 24 months',
        ];
    }

    // Handle filter changes
    public function filterQuery(): void
    {
        $this->monthsToShow = match ($this->filter) {
            'last_6_months' => 6,
            'last_24_months' => 24,
            default => 12,
        };
    }
}
