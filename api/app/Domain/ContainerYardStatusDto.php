<?php

namespace App\Domain;

final readonly class ContainerYardStatusDto
{
    public function __construct(
        public int $stoppedContainers,
        public int $contentsPriceCents,
    ) {}
}
