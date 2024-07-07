<?php

namespace App\Application\Ports\Output;

use App\Application\UseCases\ListContainer\ListContainerOutputData;
use App\Application\UseCases\ListContainer\ListContainerOutputPort;
use App\Enum\InspectionStatus;
use Carbon\Carbon;
use Illuminate\Support\Number;

class ListContainersArrayOutput implements ListContainerOutputPort
{
    public function present(ListContainerOutputData $data): array
    {
        $formattedData = array_map(function (array $item) {
            return [
                'id' => $item['id'],
                'label' => $item['label'],
                'company' => $item['company'],
                'inspection_status' => InspectionStatus::from($item['inspection_status'])->toString(),
                'packing_list' => $item['packing_list'],
                'items_count' => $item['items_count'],
                'arrival_at' => Carbon::parse($item['arrival_at'])->format('d/m/Y H:i:s'),
                'departure_at' => Carbon::parse($item['departure_at'])?->format('d/m/Y H:i:s'),
                'weight' => number_format($item['weight'], 2, ',', '.').'kg',
                'origin' => $item['origin'],
                'destination' => $item['destination'],
                'capacity' => $item['capacity'].'ft',
                'contents_price_cents' => Number::currency($item['contents_price_cents'], 'BRL'),
            ];
        }, $data->containers);

        return [
            'data' => $formattedData,
            'total' => $data->total,
        ];
    }
}
