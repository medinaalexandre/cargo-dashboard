<?php

namespace App\Http\Controllers\Dashboard;

use App\Application\UseCases\GetDashboardData\GetDashboardDataUseCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\DashboardRequest;
use Illuminate\Http\JsonResponse;

class GetDashboardDataController extends Controller
{
    public function __construct(protected readonly GetDashboardDataUseCase $useCase) {}

    public function __invoke(DashboardRequest $request): JsonResponse
    {
        $data = $this->useCase->execute($request->validated());

        return response()->json($data);
    }
}
