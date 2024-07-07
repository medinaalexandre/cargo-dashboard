<?php

namespace Database\Factories;

use App\Enum\InspectionStatus;
use App\Models\Container;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Container>
 */
class ContainerFactory extends Factory
{
    public function definition(): array
    {
        $arrivalAt = $this->faker->dateTimeInInterval('-1 year', '+1 year');
        $departureAt = clone $arrivalAt;
        $companyNames = ['foo', 'bar', 'amazon', 'ebay'];

        return [
            'label' => strtoupper("{$this->faker->lexify()}-{$this->faker->numerify('#######')}-{$this->faker->lexify('?')}"),
            'company' => $this->faker->randomElement($companyNames).' '.$this->faker->companySuffix(),
            'inspection_status' => $this->faker->randomElement(InspectionStatus::cases()),
            'packing_list' => $this->faker->text(300),
            'items_count' => $this->faker->numberBetween(1, 50),
            'arrival_at' => $arrivalAt,
            'departure_at' => $departureAt->add(new \DateInterval("P{$this->faker->numberBetween(1, 15)}D")),
            'weight' => $this->faker->randomFloat(2, 10, 1000),
            'origin' => $this->faker->country(),
            'destination' => $this->faker->country(),
            'capacity' => $this->faker->randomElement([20, 40]),
            'contents_price_cents' => $this->faker->numberBetween(50000, 10000000),
        ];
    }
}
