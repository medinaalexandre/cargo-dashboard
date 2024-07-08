<?php

use App\Models\Container;

it('returns the filters in the expected way', function () {
    $this->get(route('filter.options'))
        ->assertOk()
        ->assertJsonStructure([
            'origin',
            'destination'
        ]);
});

it('return the available origin and destinations', function () {
    Container::factory()->create([
        'origin' => 'Portugal',
        'destination' => 'Germany'
    ]);
    Container::factory()->create([
        'origin' => 'Brazil',
        'destination' => 'Argentina',
    ]);
    Container::factory()->create([
        'origin' => 'Guinea',
        'destination' => 'Malta',
    ]);

    $this->get(route('filter.options'))
        ->assertJsonPath('origin', ['Brazil', 'Guinea', 'Portugal'])
        ->assertJsonPath('destination', ['Argentina', 'Germany', 'Malta']);
});
