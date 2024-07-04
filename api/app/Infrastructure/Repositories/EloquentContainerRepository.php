<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\ContainerRepository;
use App\Models\Container;

final readonly class EloquentContainerRepository implements ContainerRepository
{
    public function __construct(private Container $model)
    {
    }

    public function findByFilters(array $filters): array
    {
        $query = $this->model->newQuery();

        return $query
            ->paginate(
                perPage: $filters['per_page'] ?? 10,
                page: $filters['page']  ?? 1
            )
            ->toArray();
    }
}
