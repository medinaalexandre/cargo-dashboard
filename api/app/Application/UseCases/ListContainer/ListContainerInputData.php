<?php

namespace App\Application\UseCases\ListContainer;

final class ListContainerInputData
{
    public function __construct(
        public array $filters
    ) {}
}
