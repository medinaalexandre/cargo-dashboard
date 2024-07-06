<?php

namespace App\Application\UseCases;

interface ListContainerOutputPort
{
    public function present(ListContainerOutputData $data): mixed;
}
