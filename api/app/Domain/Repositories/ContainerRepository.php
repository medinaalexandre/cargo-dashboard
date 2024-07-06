<?php

namespace App\Domain\Repositories;

interface ContainerRepository
{
    public function findByFilters(array $filters): array;

    public function countByFilters(array $filters): int;
}
