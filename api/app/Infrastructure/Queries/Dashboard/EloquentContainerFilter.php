<?php

namespace App\Infrastructure\Queries\Dashboard;

use Illuminate\Support\Arr;

trait EloquentContainerFilter
{
    public function applyFilters($query, array $filters, string $tablePrefix = 'containers'): void
    {
        self::applyWhereInIfPresent($query, $filters, 'origin', $tablePrefix);
        self::applyWhereInIfPresent($query, $filters, 'destination', $tablePrefix);
        self::applyWhereInIfPresent($query, $filters, 'inspection_status', $tablePrefix);

        if (Arr::has($filters, 'items_count') && $filters['items_count']) {
            $query->where("$tablePrefix.items_count", $filters['items_count']);
        }

        if (Arr::has($filters, 'packing_list') && $filters['packing_list']) {
            $query->where("$tablePrefix.packing_list", 'LIKE', "%{$filters['packing_list']}%");
        }
    }

    protected static function applyWhereInIfPresent($query, array $filters, string $key, string $tablePrefix): void
    {
        if (Arr::has($filters, $key) && ! empty($filters[$key])) {
            $query->whereIn("$tablePrefix.$key", $filters[$key]);
        }
    }
}
