<?php

namespace App\Domain;

class ContainerYardHistoryDay
{
    public function __construct(
        public string $date,
        public int $stoppedContainers,
    ) {}
}
