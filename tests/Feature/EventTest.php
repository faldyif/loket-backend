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
        $locationData = [
            'name' => 'Gedung ' . title_case($this->faker->words(2, true)),
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude
        ];
        $this->post(url('location/create'), $locationData)
            ->assertStatus(201);
        $this->assertDatabaseHas('locations', $locationData);

        // create event
        $eventData = [
            'name' => title_case($this->faker->words('3', true)),
            'description' => $this->faker->paragraph('5'),
            'location_id' => 1,
            'start_at' => $this->faker->dateTime(),
            'end_at' => $this->faker->dateTime()
        ];
        $this->post(url('event/create'), $eventData)
            ->assertStatus(201);
        $this->assertDatabaseHas('events', $eventData);
    }

    public function testGetEvent()
    {
        // create location
        $locationData = [
            'name' => 'Gedung ' . title_case($this->faker->words(2, true)),
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude
        ];
        $this->post(url('location/create'), $locationData)
            ->assertStatus(201);
        $this->assertDatabaseHas('locations', $locationData);

        // create event
        $eventData = [
            'name' => title_case($this->faker->words('3', true)),
            'description' => $this->faker->paragraph('5'),
            'location_id' => 1,
            'start_at' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'end_at' => $this->faker->dateTime()->format('Y-m-d H:i:s')
        ];
        $this->post(url('event/create'), $eventData)
            ->assertStatus(201);
        $this->assertDatabaseHas('events', $eventData);

        // create ticket type
        $ticketTypeData = [
            'event_id' => 1,
            'quota' => $this->faker->numberBetween(1, 5000),
            'price' => $this->faker->numberBetween(20000, 100000000)
        ];
        $this->post(url('event/ticket/create'), $ticketTypeData)
            ->assertStatus(201);
        $this->assertDatabaseHas('ticket_types', $ticketTypeData);

        // get event
        $this->get(url('event/get_info'))
            ->assertJsonFragment([
                'name' => $eventData['name'],
            ]);
    }
}
