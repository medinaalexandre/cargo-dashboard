<?php

namespace App\Application\UseCases\GetDashboardData;

use App\Domain\ContainerYard;
use App\Domain\Queries\Dashboard\ContainerYardStatusQuery;

class GetDashboardDataUseCase
{
    public function __construct(
        protected ContainerYardStatusQuery $containerYardStatusQuery,
        protected GetDashboardDataOutputPort $outputPort,
    ) {}

    public function execute()
    {
        $containerYardStatus = $this->containerYardStatusQuery->execute();
        $containerYard = new ContainerYard($containerYardStatus->stoppedContainers);

        return $this->outputPort->present(new GetDashboardDataOutputData(
            $containerYardStatus->stoppedContainers,
            $containerYardStatus->contentsPriceCents,
            $containerYard->getUsagePercentage(),
        ));
    }
}
