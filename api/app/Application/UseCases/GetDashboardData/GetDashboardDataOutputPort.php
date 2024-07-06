<?php

namespace App\Application\UseCases\GetDashboardData;

interface GetDashboardDataOutputPort
{
    public function present(GetDashboardDataOutputData $data): mixed;
}
