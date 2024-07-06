<?php

namespace App\Application\UseCases;

final class ListContainerInputData
{
    public function __construct(
        public array $filters
    ) {
    }
}
