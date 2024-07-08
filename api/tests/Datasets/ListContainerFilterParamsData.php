<?php

use App\Enum\InspectionStatus;

dataset('list container filter params', [
    'origin' => fn () => [
        'random_records' => ['origin' => 'Argentina'],
        'matching_records' => ['origin' => 'Brazil'],
        'request' => ['origin' => ['Brazil']],
        'expected_count' => 2,
    ],
    'destination' => fn () => [
        'random_records' => ['destination' => 'Argentina'],
        'matching_records' => ['destination' => 'Brazil'],
        'request' => ['destination' => ['Brazil']],
        'expected_count' => 3,
    ],
    'inspection_status' => fn () => [
        'random_records' => ['inspection_status' => InspectionStatus::INSPECTION_STATUS_APPROVED],
        'matching_records' => ['inspection_status' => InspectionStatus::INSPECTION_STATUS_PENDING],
        'request' => ['inspection_status' => [InspectionStatus::INSPECTION_STATUS_PENDING->value]],
        'expected_count' => 4,
    ],
    'packing_list' => fn () => [
        'random_records' => ['packing_list' => 'Random packing list'],
        'matching_records' => ['packing_list' => 'Matching packing list'],
        'request' => ['packing_list' => 'Matching packing list'],
        'expected_count' => 6,
    ],
    'items_count' => fn () => [
        'random_records' => ['items_count' => 30],
        'matching_records' => ['items_count' => 10],
        'request' => ['items_count' => 10],
        'expected_count' => 5,
    ],
]);
