<?php

namespace App\Domain;

final readonly class ContainerYard
{
    private const int CONTAINER_CAPACITY = 150;

    public function __construct(
        private readonly int $stoppedContainers
    ) {}

    public function getUsagePercentage(): float
    {
        return $this->stoppedContainers / self::CONTAINER_CAPACITY;
    }
}
