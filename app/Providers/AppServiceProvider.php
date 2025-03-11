<?php

namespace App\Providers;
use App\Http\Responses\LogoutResponse;
use App\Models\Announcement;
use App\Observers\AnnouncementObserver;
use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Announcement::observe(AnnouncementObserver::class);
    }
}
