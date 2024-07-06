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

        return [
            'label' => strtoupper("{$this->faker->lexify()}-{$this->faker->numerify('#######')}-{$this->faker->lexify('?')}"),
            'company' => $this->faker->company(),
            'inspection_status' => $this->faker->randomElement(InspectionStatus::cases()),
            'packing_list' => $this->faker->text(300),
            'items_count' => $this->faker->numberBetween(1, 50),
            'arrival_at' => $arrivalAt,
            'departure_at' => $departureAt->add(new \DateInterval("P{$this->faker->numberBetween(1, 15)}D")),
            'weight' => $this->faker->randomFloat(2, 10),
            'origin' => $this->faker->city(),
            'destination' => $this->faker->city(),
            'capacity' => $this->faker->randomFloat(2, 1, 2),
            'contents_price_cents' => $this->faker->numberBetween(50000, 10000000),
        ];
    }
}
