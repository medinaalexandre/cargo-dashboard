<?php

use App\Http\Controllers\Containers\ListContainersController;
use App\Http\Controllers\Dashboard\GetDashboardDataController;
use App\Http\Controllers\Filters\OptionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/container', ListContainersController::class)->name('containers.list');
Route::get('/dashboard', GetDashboardDataController::class)->name('dashboard.data');
Route::get('/filters/options', OptionsController::class)->name('filter.options');
