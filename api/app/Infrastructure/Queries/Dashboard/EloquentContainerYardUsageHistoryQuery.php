<?php

namespace App\Infrastructure\Queries\Dashboard;

use App\Domain\ContainerYardHistoryDay;
use App\Domain\Queries\Dashboard\ContainerYardUsageHistoryQuery;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class EloquentContainerYardUsageHistoryQuery implements ContainerYardUsageHistoryQuery
{
    public function execute(): array
    {
        return DB::table(DB::raw(
            "(SELECT generate_series(NOW() - INTERVAL '30 DAYS', NOW(), '1 DAY')::date as date) date_series"
        ))->selectRaw('date_series.date, COUNT(*) as containers_count')
            ->leftJoin('containers', function (JoinClause $join) {
                $join->on('date_series.date', '>=', DB::raw('containers.arrival_at::date'))
                    ->on('date_series.date', '<=', DB::raw('containers.departure_at::date'));
            })->groupBy('date_series.date')
            ->orderBy('date_series.date')
            ->get()
            ->map(fn ($item) => new ContainerYardHistoryDay($item->date, $item->containers_count))
            ->toArray();
    }
}
