<?php

namespace App\Domain;

class CompanyContainerAvgDay
{
    public function __construct(
        public string $company,
        public int $avgDay,
    ) {}
}
