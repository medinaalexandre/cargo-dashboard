<?php

use App\Models\Container;
use Illuminate\Testing\TestResponse;

it('can list container', function () {
    $this->get(route('containers.list'))
        ->assertOk()
        ->assertJsonStructure([
            'data',
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

it('returns the expected total records', function () {
    Container::factory()->count(20)->create();

    /** @var TestResponse $res */
    $res = $this->getJson(route('containers.list'));
    $res->assertOk()
        ->assertJsonPath('total', 20);
});

it('filter test', function (array $filter) {
    Container::factory()->count(5)->create($filter['random_records']);
    Container::factory()->count($filter['expected_count'])->create($filter['matching_records']);

    $res = $this->getJson(route('containers.list', $filter['request']));
    $res->assertOk()
        ->assertJsonPath('total', $filter['expected_count']);
})->with('list container filter params');
