<?php

namespace App\Infrastructure\Queries\Dashboard;

use App\Domain\ContainerYardStatusDto;
use App\Domain\Queries\Dashboard\ContainerYardStatusQuery;
use App\Models\Container;

class EloquentContainerYardStatusQuery implements ContainerYardStatusQuery
{
    public function execute(): ContainerYardStatusDto
    {
        $status = Container::query()
            ->selectRaw('COUNT(*) as stopped_containers, SUM(contents_price_cents) as content_price_cents')
            ->whereNull('departure_at')
            ->first();

        return new ContainerYardStatusDto(
            $status->stopped_containers,
            $status->content_price_cents,
        );
    }
}
