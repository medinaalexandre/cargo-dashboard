<?php

namespace App\Http\Controllers\Dashboard;

use App\Application\UseCases\GetDashboardData\GetDashboardDataUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class GetDashboardDataController extends Controller
{
    public function __construct(protected readonly GetDashboardDataUseCase $useCase) {}

    public function __invoke(): JsonResponse
    {
        $data = $this->useCase->execute();

        return response()->json($data);
    }
}
