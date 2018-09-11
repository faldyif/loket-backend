<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketTypeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateNewTicketType()
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

        // create ticket type
        $data = [
            'event_id' => 1,
            'quota' => $this->faker->numberBetween(1, 5000),
            'price' => $this->faker->numberBetween(20000, 100000000)
        ];
        $this->post(url('event/ticket/create'), $data)
            ->assertStatus(201);
        $this->assertDatabaseHas('ticket_types', $data);
    }
}
