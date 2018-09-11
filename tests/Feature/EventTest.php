<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    public function testCreateNewEvent()
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

        // create event
        $data = [
            'name' => title_case($this->faker->words('3', true)),
            'description' => $this->faker->paragraph('5'),
            'location_id' => 1,
            'start_at' => $this->faker->dateTime(),
            'end_at' => $this->faker->dateTime()
        ];
        $this->post(url('event/create'), $data)
            ->assertStatus(201);
        $this->assertDatabaseHas('events', $data);
    }
}
