<?php

namespace App\Providers;

use App\Domain\Queries\Dashboard\ContainerYardPerCompanyQuery;
use App\Domain\Queries\Dashboard\ContainerYardStatusQuery;
use App\Domain\Queries\Dashboard\ContainerYardUsageHistoryQuery;
use App\Infrastructure\Queries\Dashboard\EloquentContainerYardPerCompanyQuery;
use App\Infrastructure\Queries\Dashboard\EloquentContainerYardStatusQuery;
use App\Infrastructure\Queries\Dashboard\EloquentContainerYardUsageHistoryQuery;
use Illuminate\Support\ServiceProvider;

class QueryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ContainerYardStatusQuery::class => EloquentContainerYardStatusQuery::class,
        ContainerYardPerCompanyQuery::class => EloquentContainerYardPerCompanyQuery::class,
        ContainerYardUsageHistoryQuery::class => EloquentContainerYardUsageHistoryQuery::class,
    ];
}
