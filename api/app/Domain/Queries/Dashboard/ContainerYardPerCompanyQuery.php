<?php

namespace App\Domain\Queries\Dashboard;

use App\Domain\ContainerYardPerCompanyDto;

interface ContainerYardPerCompanyQuery
{
    public function execute(): ContainerYardPerCompanyDto;
}
