<?php

namespace App\Application\UseCases\GetDashboardData;

use App\Domain\Entities\ContainerYard;
use App\Domain\Queries\Dashboard\ContainerYardPerCompanyQuery;
use App\Domain\Queries\Dashboard\ContainerYardStatusQuery;

class GetDashboardDataUseCase
{
    public function __construct(
        protected ContainerYardStatusQuery $containerYardStatusQuery,
        protected ContainerYardPerCompanyQuery $containerYardPerCompanyQuery,
        protected GetDashboardDataOutputPort $outputPort,
    ) {}

    public function execute()
    {
        $containerYardStatus = $this->containerYardStatusQuery->execute();
        $containerYardPerCompany = $this->containerYardPerCompanyQuery->execute();
        $containerYard = new ContainerYard($containerYardStatus->stoppedContainers);

        return $this->outputPort->present(new GetDashboardDataOutputData(
            $containerYardStatus->stoppedContainers,
            $containerYardStatus->contentsPriceCents,
            $containerYard->getUsagePercentage(),
            $containerYardStatus->destinations,
            $containerYardStatus->origins,
            $containerYardPerCompany->companiesContainerAvgDay,
        ));
    }
}
