<?php

namespace App\Application\Ports\Output;

use App\Application\UseCases\GetDashboardData\GetDashboardDataOutputData;
use App\Application\UseCases\GetDashboardData\GetDashboardDataOutputPort;

class GetDashboardDataArrayOutput implements GetDashboardDataOutputPort
{
    public function present(GetDashboardDataOutputData $data): array
    {
        $numberFormatter = new \NumberFormatter('pt_BR', \NumberFormatter::PADDING_POSITION);

        return [
            'stopped_containers' => $data->stoppedContainers,
            'contents_price' => $numberFormatter->format($data->contentsPriceCents),
            'usage_percentage' => (int) ($data->usagePercentage * 100),
            'destinations' => $data->destinations,
            'origins' => $data->origins,
            'companies_container_avg_day' => $data->companiesContainerAvgDay
        ];
    }
}
