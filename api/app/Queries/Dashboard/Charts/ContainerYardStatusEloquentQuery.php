<?php

namespace App\Queries\Dashboard\Charts;

use App\Models\Container;

class ContainerYardStatusEloquentQuery implements ContainerYardStatusQuery
{
    public function execute(): ContainerYardStatusDto
    {
        $status = Container::query()
            ->selectRaw('COUNT(*) as stopped_containers, SUM(content_price_cents) as content_price_cents')
            ->whereNull('departure_at')
            ->first();

    }
}
