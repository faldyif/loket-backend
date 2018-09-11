<?php

namespace Tests\Feature;

use App\Customer;
use App\Transaction;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionTest extends TestCase
{

    public function testCreateNewTransaction()
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

        // create ticket type
        $ticketTypeData = [
            'event_id' => 1,
            'quota' => $this->faker->numberBetween(1, 5000),
            'price' => $this->faker->numberBetween(20000, 100000000)
        ];
        $this->post(url('event/ticket/create'), $ticketTypeData)
            ->assertStatus(201);
        $this->assertDatabaseHas('ticket_types', $ticketTypeData);

        // make purchase
        $customerData = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address
        ];
        $transactionData = [
            'customer' => $customerData,
            'event_id' => 1,
            'ticket_types' => [
                [
                    'ticket_type_id' => 1,
                    'quantity' => $this->faker->numberBetween(1, $ticketTypeData['quota'])
                ]
            ]
        ];
        $this->post(url('transaction/purchase'), $transactionData)
            ->assertExactJson([]);

        $this->assertDatabaseHas('customers', $customerData);

    }

    public function testGetTransaction()
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

        // create ticket type
        $ticketTypeData = [
            'event_id' => 1,
            'quota' => $this->faker->numberBetween(1, 5000),
            'price' => $this->faker->numberBetween(20000, 100000000)
        ];
        $this->post(url('event/ticket/create'), $ticketTypeData)
            ->assertStatus(201);
        $this->assertDatabaseHas('ticket_types', $ticketTypeData);

        // make purchase
        $customerData = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address
        ];
        $transactionData = [
            'customer' => $customerData,
            'event_id' => 1,
            'ticket_types' => [
                [
                    'ticket_type_id' => 1,
                    'quantity' => $this->faker->numberBetween(1, $ticketTypeData['quota'])
                ]
            ]
        ];
        $this->post(url('transaction/purchase'), $transactionData)
            ->assertExactJson([]);

        $this->assertDatabaseHas('customers', $customerData);

        // get transaction
        $this->get(url('transaction/get_info'))
            ->assertStatus(200);
    }
}
