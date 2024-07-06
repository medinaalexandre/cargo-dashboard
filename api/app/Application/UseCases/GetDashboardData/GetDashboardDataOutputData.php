<?php

namespace App\Application\UseCases\GetDashboardData;

final readonly class GetDashboardDataOutputData
{
    public function __construct(
        public int $stoppedContainers,
        public int $contentsPriceCents,
        public float $usagePercentage,
    ) {}
}
