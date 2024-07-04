<?php

namespace Database\Seeders;

use App\Models\Container;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ContainerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();
        $companies = [];

        for ($i = 0; $i < 50; $i++) {
            $companies[] = $faker->company();
        }

        Container::factory(2048)
            ->state([
                'company' => $faker->randomElement($companies),
            ])
            ->create();
        Container::factory(64)->state(
            [
                'company' => $faker->randomElement($companies),
                'arrival_at' => Carbon::now()->subWeek(),
                'departure_at' => null,
            ]
        )->create();
        Container::factory(16)->state([
            'origin' => 'Porto Alegre',
            'destination' => 'Salvador',
        ])->create();
        Container::factory(32)->state([
            'origin' => 'Miami',
            'destination' => 'Rio Grande',
        ])->create();
    }
}
