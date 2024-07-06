<?php

namespace App\Application\UseCases\ListContainer;

final readonly class ListContainerOutputData
{
    public function __construct(
        public array $containers,
        public int $total,
    ) {}
}
