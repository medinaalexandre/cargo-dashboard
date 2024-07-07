<?php

namespace App\Http\Controllers\Filters;

use App\Http\Controllers\Controller;
use App\Models\Container;

class OptionsController extends Controller
{
    public function __invoke()
    {
        $origin = Container::query()
            ->select('origin')
            ->distinct('origin')
            ->pluck('origin')
            ->toArray();

        $destination = Container::query()
            ->select('destination')
            ->distinct('destination')
            ->pluck('destination')
            ->toArray();

        return response()->json(compact('origin', 'destination'));
    }
}
