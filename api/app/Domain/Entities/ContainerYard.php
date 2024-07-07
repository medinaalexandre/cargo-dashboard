<?php

namespace App\Domain\Entities;

final readonly class ContainerYard
{
    private const int CONTAINER_CAPACITY = 150;

    public function getUsagePercentage(int $stoppedContainers): float
    {
        return $stoppedContainers / self::CONTAINER_CAPACITY;
    }
}
