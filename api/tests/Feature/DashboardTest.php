<?php

use App\Models\Container;

it('returns data in the expected way', function () {
    $this->getJson(route('dashboard.data'))
        ->assertOk()
        ->assertJsonStructure([
            'stopped_containers',
            'contents_price',
            'usage_percentage',
            'destinations',
            'origins',
            'companies_container_avg_day',
            'usage_history',
        ]);
});

it('returns the correct data', function () {
    Container::factory()->count(2)->create([
        'origin' => 'Brazil',
        'destination' => 'Argentina',
        'departure_at' => null,
    ]);
    Container::factory()->count(3)->create([
        'origin' => 'Portugal',
        'destination' => 'Germany'
    ]);

    $this->getJson(route('dashboard.data'))
        ->assertJsonPath('stopped_containers', 2)
        ->assertJsonPath('origins', [
            ['location' => 'Portugal', 'count' => 3],
            ['location' => 'Brazil', 'count' => 2],
        ])
        ->assertJsonPath('destinations', [
            ['location' => 'Germany', 'count' => 3],
            ['location' => 'Argentina', 'count' => 2],
        ]);
});
