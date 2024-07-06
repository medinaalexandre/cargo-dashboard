<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\ContainerRepository;

final readonly class ListContainersUseCase
{
    public const int FIRST_PAGE = 1;
    public const int DEFAULT_PER_PAGE = 10;

    public function __construct(
        private ContainerRepository $containerRepository,
        private ListContainerOutputPort $outputPort,
    ) {}

    public function execute(ListContainerInputData $input): mixed
    {
        $input->filters['page'] ??= self::FIRST_PAGE;
        $input->filters['per_page'] ??= self::DEFAULT_PER_PAGE;

        return $this->outputPort->present(new ListContainerOutputData(
            $this->containerRepository->findByFilters($input->filters),
            $this->containerRepository->countByFilters($input->filters)
        ));
    }
}
