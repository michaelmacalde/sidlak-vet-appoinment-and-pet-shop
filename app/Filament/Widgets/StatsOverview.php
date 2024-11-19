<?php

namespace App\Filament\Widgets;

use App\Models\Adoption\Adoption;
use App\Models\Animal\Dog;
use App\Models\Donation\Donation;
use App\Models\Volunteer\Volunteer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Enums\IconPosition;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '60s';
    protected static ?int $sort = 2;
    protected function getStats(): array
    {
        $pendingCount = Adoption::where('status', 'pending')->count();

        return [
            Stat::make('Total', Dog::count())
                ->descriptionIcon('heroicon-s-users', IconPosition::Before)
                ->description('Registered dogs')
                ->color('success')
                ->chart($this->getDogRegistrationChart()),

            Stat::make('Adoptions', Adoption::where('status', 'approved')->count())
                ->descriptionIcon('heroicon-s-heart',IconPosition::Before)
                ->description('Adopted dogs')
                ->color('danger')
                ->url(route('filament.admin.resources.adoption.adoptions.index', [
                    'tableFilters[status][value]' => 'pending'
                ]))
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),

            Stat::make('Donations', $this->formatAmount(Donation::sum('donor_amount')))
                ->descriptionIcon('heroicon-s-gift', IconPosition::Before)
                ->description('Received donations')
                ->color('success'),

            Stat::make('Volunteers', Volunteer::count())
                ->descriptionIcon('heroicon-s-users', IconPosition::Before)
                ->description('Registered volunteers')
                ->color('primary')
        ];
    }

    protected function getDogRegistrationChart(): array
    {
        return $this->getChartData(Dog::class);
    }

    protected function getAdoptionsChart(): array
    {
        return $this->getChartData(Adoption::class);
    }

    protected function getDonationsChart(): array
    {
        return DB::table('donations')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(donor_amount) as total'))
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total')
            ->map(fn ($value) => round($value / 100, 2))
            ->toArray();
    }

    protected function getVolunteersChart(): array
    {
        return $this->getChartData(Volunteer::class);
    }

    protected function getChartData(string $model): array
    {
        return $model::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count')
            ->toArray();
    }

    protected function getAdoptionsDifference(): int
    {
        return $this->getDifference(Adoption::class);
    }

    protected function getVolunteersDifference(): int
    {
        return $this->getDifference(Volunteer::class);
    }

    protected function getDonationsDifference(): float
    {
        $currentMonth = Donation::whereBetween('created_at', [
            now()->startOfMonth(),
            now()->endOfMonth(),
        ])->sum('donor_amount');

        $lastMonth = Donation::whereBetween('created_at', [
            now()->subMonth()->startOfMonth(),
            now()->subMonth()->endOfMonth(),
        ])->sum('donor_amount');

        if ($lastMonth == 0) {
            return 0;
        }

        return (($currentMonth - $lastMonth) / $lastMonth) * 100;
    }

    protected function getDifference(string $model): int
    {
        $currentMonth = $model::whereBetween('created_at', [
            now()->startOfMonth(),
            now()->endOfMonth(),
        ])->count();

        $lastMonth = $model::whereBetween('created_at', [
            now()->subMonth()->startOfMonth(),
            now()->subMonth()->endOfMonth(),
        ])->count();

        return $currentMonth - $lastMonth;
    }

    protected function formatAmount(float $amount): string
    {
        if ($amount >= 1000000) {
            return round($amount / 1000000, 1) . 'M';
        }
        if ($amount >= 1000) {
            return round($amount / 1000, 1) . 'K';
        }
        return (string) $amount;
    }
}
