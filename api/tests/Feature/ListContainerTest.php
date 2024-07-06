<?php

use Illuminate\Testing\TestResponse;

it('can list container', function () {
    $this->get(route('containers.list'))
        ->assertOk()
        ->assertJsonStructure([
            'current_page',
            'data',
            'last_page',
            'per_page',
            'total',
        ]);
});

it('limit the page size', function () {
    /** @var TestResponse $res */
    $res = $this->getJson(route('containers.list', ['per_page' => 200]));

    $res->assertUnprocessable();
    expect($res->getContent())->toContain('per page field must not be greater than 100');
});

it('cannot render a negative page', function () {
    /** @var TestResponse $res */
    $res = $this->getJson(route('containers.list', ['page' => 0]));

    $res->assertUnprocessable();
    expect($res->getContent())->toContain('page field must be at least 1');
});
