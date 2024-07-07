<?php

namespace App\Application\UseCases\GetDashboardData;

use App\Domain\ContainerYardHistoryDay;
use App\Domain\Entities\ContainerYard;
use App\Domain\Queries\Dashboard\ContainerYardPerCompanyQuery;
use App\Domain\Queries\Dashboard\ContainerYardStatusQuery;
use App\Domain\Queries\Dashboard\ContainerYardUsageHistoryQuery;

class GetDashboardDataUseCase
{
    public function __construct(
        protected ContainerYardStatusQuery $containerYardStatusQuery,
        protected ContainerYardPerCompanyQuery $containerYardPerCompanyQuery,
        protected ContainerYardUsageHistoryQuery $containerYardUsageHistoryQuery,
        protected GetDashboardDataOutputPort $outputPort,
    ) {}

    public function execute(array $filters)
    {
        $containerYard = new ContainerYard();
        $containerYardStatus = $this->containerYardStatusQuery->execute($filters);
        $containerYardPerCompany = $this->containerYardPerCompanyQuery->execute($filters);
        $containerYardUsageHistory = $this->containerYardUsageHistoryQuery->execute($filters);

        $usageHistory = array_map(function (ContainerYardHistoryDay $day) use ($containerYard) {
            return [
                'date' => $day->date,
                'usage' => $containerYard->getUsagePercentage($day->stoppedContainers),
            ];
        }, $containerYardUsageHistory);

        return $this->outputPort->present(new GetDashboardDataOutputData(
            $containerYardStatus->stoppedContainers,
            $containerYardStatus->contentsPriceCents,
            $containerYard->getUsagePercentage($containerYardStatus->stoppedContainers),
            $containerYardStatus->destinations,
            $containerYardStatus->origins,
            $containerYardPerCompany->companiesContainerAvgDay,
            $usageHistory,
        ));
    }
}
