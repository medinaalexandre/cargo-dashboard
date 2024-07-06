<?php

namespace App\Http\Controllers\Containers;

use App\Application\UseCases\ListContainersUseCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\Container\ListContainerRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListContainersController extends Controller
{
    public function __construct(
        private readonly ListContainersUseCase $useCase
    ) {}

    public function __invoke(ListContainerRequest $request): JsonResponse
    {
        $containers = $this->useCase->execute($request->validated());

        return response()->json($containers);
    }
}
