<?php

namespace App\Application\Ports\Output;

use App\Application\UseCases\GetDashboardData\GetDashboardDataOutputData;
use App\Application\UseCases\GetDashboardData\GetDashboardDataOutputPort;

class GetDashboardDataArrayOutput implements GetDashboardDataOutputPort
{
    public function present(GetDashboardDataOutputData $data): array
    {
        return [
            'stopped_containers' => $data->stoppedContainers,
            'contents_price_cents' => $data->contentsPriceCents,
            'usage_percentage' => $data->usagePercentage,
        ];
    }
}
