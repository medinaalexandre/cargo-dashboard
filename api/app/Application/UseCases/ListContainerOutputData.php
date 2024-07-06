<?php

namespace App\Application\UseCases;

final readonly class ListContainerOutputData
{
    public function __construct(
        public array $containers,
        public int $total,
    ) { }
}
