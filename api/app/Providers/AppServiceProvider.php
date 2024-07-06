<?php

namespace App\Providers;

use App\Application\Ports\Output\ListContainersArrayOutput;
use App\Application\UseCases\ListContainerOutputPort;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ListContainerOutputPort::class, ListContainersArrayOutput::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
