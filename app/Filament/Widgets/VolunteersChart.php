<?php

namespace App\Filament\Widgets;

use App\Models\Volunteer\Volunteer;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VolunteersChart extends ChartWidget
{
    protected static ?string $heading = 'Volunteer Analytics';

    protected static ?int $sort = 4;

    // Refresh interval in seconds
    protected static ?string $pollingInterval = '30s';

    // Chart view type (roles, status, or trends)
    protected string $viewType = 'trends';

    protected function getData(): array
    {
        return match ($this->viewType) {
            'roles' => $this->getRoleDistributionData(),
            'status' => $this->getStatusDistributionData(),
            default => $this->getVolunteerTrendsData(),
        };
    }

    protected function getRoleDistributionData(): array
    {
        $roleData = Volunteer::select('role', DB::raw('COUNT(*) as count'))
            ->where('status_type', 'approved')
            ->groupBy('role')
            ->get();

        $roleColors = [
            'dog_walking' => '#4CAF50',
            'event_assistance' => '#2196F3',
            'admin_support' => '#FFC107',
            'community_outreach' => '#9C27B0'
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Volunteers by Role',
                    'data' => $roleData->pluck('count')->toArray(),
                    'backgroundColor' => array_values($roleColors),
                ],
            ],
            'labels' => $roleData->pluck('role')->map(function($role) {
                return ucwords(str_replace('_', ' ', $role));
            })->toArray(),
        ];
    }

    protected function getStatusDistributionData(): array
    {
        $statusData = Volunteer::select('status_type', DB::raw('COUNT(*) as count'))
            ->groupBy('status_type')
            ->get();

        $statusColors = [
            'approved' => '#4CAF50',
            'pending' => '#FFC107',
            'rejected' => '#F44336'
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Volunteer Status Distribution',
                    'data' => $statusData->pluck('count')->toArray(),
                    'backgroundColor' => array_map(fn($status) => $statusColors[$status],
                        $statusData->pluck('status_type')->toArray()),
                ],
            ],
            'labels' => $statusData->pluck('status_type')->map(function($status) {
                return ucfirst($status);
            })->toArray(),
        ];
    }

    protected function getVolunteerTrendsData(): array
    {
        $startDate = Carbon::now()->subMonths(5)->startOfMonth();

        // Get monthly data for approved volunteers
        $monthlyData = Volunteer::select(
            DB::raw('DATE_FORMAT(joined_date, "%Y-%m") as month'),
            'status',
            DB::raw('COUNT(*) as count')
        )
            ->where('joined_date', '>=', $startDate)
            ->where('status_type', 'approved')
            ->groupBy('month', 'status')
            ->orderBy('month')
            ->get();

        // Prepare datasets
        $labels = [];
        $activeData = [];
        $inactiveData = [];

        // Generate data for last 6 months
        for ($i = 0; $i < 6; $i++) {
            $currentDate = Carbon::now()->subMonths(5 - $i);
            $monthKey = $currentDate->format('Y-m');

            $labels[] = $currentDate->format('M Y');

            $monthData = $monthlyData->where('month', $monthKey);
            $activeData[] = $monthData->where('status', 'active')->first()?->count ?? 0;
            $inactiveData[] = $monthData->where('status', 'inactive')->first()?->count ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Active Volunteers',
                    'data' => $activeData,
                    'backgroundColor' => '#4CAF50',
                    'borderColor' => '#4CAF50',
                    'fill' => false,
                ],
                [
                    'label' => 'Inactive Volunteers',
                    'data' => $inactiveData,
                    'backgroundColor' => '#FFC107',
                    'borderColor' => '#FFC107',
                    'fill' => false,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return match ($this->viewType) {
            'roles', 'status' => 'doughnut',
            default => 'line'
        };
    }

    protected function getFilters(): ?array
    {
        return [
            'trends' => 'Monthly Trends',
            'roles' => 'Role Distribution',
            'status' => 'Status Distribution',
        ];
    }

    public function filterQuery(): void
    {
        $this->viewType = $this->filter ?? 'trends';
    }

    protected function getOptions(): array
    {
        $baseOptions = [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                ],
                'tooltip' => [
                    'intersect' => false,
                    'mode' => 'index',
                ],
            ],
        ];

        // Add specific options for line chart
        if ($this->getType() === 'line') {
            $baseOptions['scales'] = [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ];
        }

        // Add specific options for doughnut chart
        if ($this->getType() === 'doughnut') {
            $baseOptions['plugins']['tooltip'] = [
                'callbacks' => [
                    'label' => "function(context) {
                        var label = context.label || '';
                        var value = context.raw || 0;
                        var total = context.dataset.data.reduce((a, b) => a + b, 0);
                        var percentage = Math.round((value / total) * 100);
                        return `${label}: ${value} (${percentage}%)`;
                    }",
                ],
            ];
        }

        return $baseOptions;
    }
}
