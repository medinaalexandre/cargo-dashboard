<?php

namespace App\Domain;

final readonly class ContainerYardStatusDto
{
    /**
     * @param LocationCountDto[] $destinations
     * @param LocationCountDto[] $origins
     */
    public function __construct(
        public int $stoppedContainers,
        public int $contentsPriceCents,
        public array $destinations,
        public array $origins,
    ) {}
}
