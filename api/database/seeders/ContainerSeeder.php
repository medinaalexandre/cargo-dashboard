<?php

namespace Database\Seeders;

use App\Models\Container;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContainerSeeder extends Seeder
{
    public function run(): void
    {
        Container::factory(2048)->create();
        Container::factory(64)->state(
            [
                'arrival_at' => Carbon::now()->subWeek(),
                'departure_at' => null,
            ]
        )->create();
        Container::factory(16)->state([
            'origin' => 'Portugal',
            'destination' => 'South Africa
            ',
        ])->create();
        Container::factory(32)->state([
            'origin' => 'Miami',
            'destination' => 'Rio Grande',
        ])->create();
    }
}
