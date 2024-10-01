<?php

namespace App\Providers;

use App\Services\PartnerSellService;
use Illuminate\Support\ServiceProvider;

class PartnerSellServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PartnerSellService::class, function ($app) {
            return new PartnerSellService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
