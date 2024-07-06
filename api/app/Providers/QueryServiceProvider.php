<?php

namespace App\Providers;

use App\Domain\Queries\Dashboard\ContainerYardStatusQuery;
use App\Infrastructure\Queries\Dashboard\EloquentContainerYardStatusQuery;
use Illuminate\Support\ServiceProvider;

class QueryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ContainerYardStatusQuery::class => EloquentContainerYardStatusQuery::class,
    ];
}
