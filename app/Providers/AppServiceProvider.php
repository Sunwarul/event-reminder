<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\EventRepositoryInterface::class,
            \App\Repositories\EventRepository::class
        );
        $this->app->bind(
            \App\Services\EventServiceInterface::class,
            \App\Services\EventService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
