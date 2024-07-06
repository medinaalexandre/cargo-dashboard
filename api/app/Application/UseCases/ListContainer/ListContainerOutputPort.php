<?php

namespace App\Application\UseCases\ListContainer;

interface ListContainerOutputPort
{
    public function present(ListContainerOutputData $data): mixed;
}
