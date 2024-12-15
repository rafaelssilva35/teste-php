<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     public function definition(): array
     {
         return [
             'type' => $this->faker->randomElement(['comercial', 'residencial']),
             'street' => $this->faker->streetName,
             'number' => $this->faker->buildingNumber,
             'complement' => $this->faker->optional()->secondaryAddress,
             'neighborhood' => $this->faker->citySuffix,
             'city' => $this->faker->city,
             'state' => $this->faker->stateAbbr,
             'zip_code' => $this->faker->postcode,
         ];
     }
}
