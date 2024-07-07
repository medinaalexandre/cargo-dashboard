<?php

namespace App\Domain\Queries\Dashboard;

use App\Domain\ContainerYardHistoryDay;

interface ContainerYardUsageHistoryQuery
{
    /**
     * @return ContainerYardHistoryDay[]
     */
    public function execute(array $filters): array;
}
