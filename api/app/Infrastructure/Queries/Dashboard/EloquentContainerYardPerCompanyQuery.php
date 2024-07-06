<?php

namespace App\Infrastructure\Queries\Dashboard;

use App\Domain\CompanyContainerAvgDay;
use App\Domain\ContainerYardPerCompanyDto;
use App\Domain\Queries\Dashboard\ContainerYardPerCompanyQuery;
use App\Models\Container;

final class EloquentContainerYardPerCompanyQuery implements ContainerYardPerCompanyQuery
{
    public function execute(): ContainerYardPerCompanyDto
    {
        $companiesContainerAvgDay = Container::query()
            ->selectRaw('company, AVG(EXTRACT(DAY FROM COALESCE(departure_at, NOW()) - arrival_at)) AS avg_day')
            ->groupBy('company')
            ->orderByRaw('avg_day DESC')
            ->limit(30)
            ->get()
            ->map(fn (Container $container) => new CompanyContainerAvgDay(
                $container->company,
                (int) ceil($container->avg_day),
            ))->toArray();

        return new ContainerYardPerCompanyDto($companiesContainerAvgDay);
    }
}
