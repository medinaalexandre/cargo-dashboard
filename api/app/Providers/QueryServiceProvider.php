<?php

namespace App\Providers;

use App\Domain\Queries\Dashboard\ContainerYardPerCompanyQuery;
use App\Domain\Queries\Dashboard\ContainerYardStatusQuery;
use App\Infrastructure\Queries\Dashboard\EloquentContainerYardPerCompanyQuery;
use App\Infrastructure\Queries\Dashboard\EloquentContainerYardStatusQuery;
use Illuminate\Support\ServiceProvider;

class QueryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ContainerYardStatusQuery::class => EloquentContainerYardStatusQuery::class,
        ContainerYardPerCompanyQuery::class => EloquentContainerYardPerCompanyQuery::class,
    ];
}
