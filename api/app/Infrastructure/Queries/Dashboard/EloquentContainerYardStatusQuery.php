<?php

namespace App\Infrastructure\Queries\Dashboard;

use App\Domain\LocationCountDto;
use App\Domain\ContainerYardStatusDto;
use App\Domain\Queries\Dashboard\ContainerYardStatusQuery;
use App\Models\Container;

final class EloquentContainerYardStatusQuery implements ContainerYardStatusQuery
{
    public function execute(): ContainerYardStatusDto
    {
        $status = Container::query()
            ->selectRaw('COUNT(*) as stopped_containers, SUM(contents_price_cents) as content_price_cents')
            ->whereNull('departure_at')
            ->first();

        $destinations = [];
        $origins = [];
        Container::query()
            ->selectRaw('destination,  count(*) as dest_count')
            ->groupBy('destination')
            ->orderByRaw('dest_count DESC')
            ->limit(10)
            ->get()
            ->each(function (Container $container) use (&$destinations) {
                $destinations[] = new LocationCountDto(
                    $container->destination,
                    $container->dest_count
                );
            });

        Container::query()
            ->selectRaw('origin,  count(*) as origin_count')
            ->groupBy('origin')
            ->orderByRaw('origin_count DESC')
            ->limit(10)
            ->get()
            ->each(function (Container $container) use (&$origins) {
                $origins[] = new LocationCountDto(
                    $container->origin,
                    $container->origin_count
                );
            });

        return new ContainerYardStatusDto(
            $status->stopped_containers,
            $status->content_price_cents,
            $destinations,
            $origins,
        );
    }
}
