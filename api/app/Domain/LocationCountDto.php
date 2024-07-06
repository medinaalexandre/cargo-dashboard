<?php

namespace App\Domain;

final readonly class LocationCountDto
{
    public function __construct(
        public string $location,
        public int $count,
    ) {}
}
