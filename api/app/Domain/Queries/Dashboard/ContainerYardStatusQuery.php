<?php

namespace App\Domain\Queries\Dashboard;

use App\Domain\ContainerYardStatusDto;

interface ContainerYardStatusQuery
{
    public function execute(): ContainerYardStatusDto;
}
