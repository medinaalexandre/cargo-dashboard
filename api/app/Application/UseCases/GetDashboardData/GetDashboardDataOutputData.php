<?php

namespace App\Application\UseCases\GetDashboardData;

final readonly class GetDashboardDataOutputData
{
    public function __construct(
        public int $stoppedContainers,
        public int $contentsPriceCents,
        public float $usagePercentage,
        public array $destinations,
        public array $origins,
        public array $companiesContainerAvgDay,
        public array $usageHistory,
    ) {}
}
