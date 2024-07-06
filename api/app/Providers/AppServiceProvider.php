<?php

namespace App\Providers;

use App\Application\Ports\Output\GetDashboardDataArrayOutput;
use App\Application\Ports\Output\ListContainersArrayOutput;
use App\Application\UseCases\GetDashboardData\GetDashboardDataOutputPort;
use App\Application\UseCases\ListContainer\ListContainerOutputPort;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ListContainerOutputPort::class, ListContainersArrayOutput::class);
        $this->app->bind(GetDashboardDataOutputPort::class, GetDashboardDataArrayOutput::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
