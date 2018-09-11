<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    use \Illuminate\Foundation\Testing\WithFaker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create($locale ?? Factory::DEFAULT_LOCALE);

        for ($i = 0; $i < 5; $i++) {
            \App\Location::create([
                'name' => 'Gedung ' . title_case($faker->words(2, true)),
                'city' => $faker->city,
                'address' => $faker->address,
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude
            ]);
        }
    }
}
