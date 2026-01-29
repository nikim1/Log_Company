<?php

namespace Database\Factories;

use App\Models\LogisticCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Office>
 */
class OfficeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Branch ' . $this->faker->numberBetween(1, 10),
            'city' => $this->faker->city,
            'address' => $this->faker->streetAddress,
            'phone' => $this->faker->phoneNumber(),
            'company_id' => LogisticCompany::factory(),
        ];
    }
}
