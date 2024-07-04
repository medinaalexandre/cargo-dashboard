<?php

namespace App\Providers;

use App\Domain\Repositories\ContainerRepository;
use App\Infrastructure\Repositories\EloquentContainerRepository;
use App\Models\Container;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ContainerRepository::class, function ($app) {
            return new EloquentContainerRepository(new Container());
        });
    }
}
