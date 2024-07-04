<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\ContainerRepository;

class ListContainersUseCase
{
    public function __construct(
        private ContainerRepository $containerRepository
    ) {}

    public function execute(array $filters): array
    {
        return $this->containerRepository->findByFilters($filters);
    }
}
