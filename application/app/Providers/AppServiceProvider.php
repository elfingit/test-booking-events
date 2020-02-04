<?php

namespace App\Providers;

use App\Contracts\EventLocationServiceContract;
use App\Contracts\PlaceServiceContract;
use App\Contracts\ReservationServiceContract;
use App\Services\EventLocationService;
use App\Services\PlaceService;
use App\Services\ReservationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(EventLocationServiceContract::class, EventLocationService::class);
        $this->app->bind(PlaceServiceContract::class, PlaceService::class);
        $this->app->bind(ReservationServiceContract::class, ReservationService::class);
    }
}
