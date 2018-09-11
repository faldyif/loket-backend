<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateLocation()
    {
        // create location
        $data = [
            'name' => 'Gedung ' . title_case($this->faker->words(2, true)),
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude
        ];
        $this->post(url('location/create'), $data)
            ->assertStatus(201);
        $this->assertDatabaseHas('locations', $data);
    }
}
