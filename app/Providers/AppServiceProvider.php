<?php

namespace App\Providers;
use App\Http\Responses\LogoutResponse;
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

    }
}
