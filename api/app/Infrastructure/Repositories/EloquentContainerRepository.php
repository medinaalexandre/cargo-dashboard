<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\ContainerRepository;
use App\Models\Container;

final readonly class EloquentContainerRepository implements ContainerRepository
{
    public function __construct(private Container $model) {}

    public function findByFilters(array $filters): array
    {
        $query = $this->model->newQuery();

        return $query
            ->offset(($filters['page'] - 1) * $filters['per_page'])
            ->limit($filters['per_page'])
            ->get()
            ->toArray();
    }

    public function countByFilters(array $filters): int
    {
        return $this->model->newQuery()->count();
    }
}
