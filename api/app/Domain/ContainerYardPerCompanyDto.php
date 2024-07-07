<?php

namespace App\Domain;

class ContainerYardPerCompanyDto
{
    public function __construct(
        public array $companiesContainerAvgDay
    ) {}
}
