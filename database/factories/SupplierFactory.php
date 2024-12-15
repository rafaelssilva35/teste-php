<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Contact;
use App\Models\Document;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
        ];
    }


    /**
     * Define the relationship with documents.
     */
    public function configure(): self
    {
        return $this->afterCreating(function (Supplier $supplier) {
            $supplier->documents()->createMany(
                Document::factory(2)->make()->toArray()
            );
            $supplier->addresses()->createMany(
                Address::factory(2)->make()->toArray()
            );
            $supplier->contacts()->createMany(
                Contact::factory(2)->make()->toArray()
            );
        });
    }
}
