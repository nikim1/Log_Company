<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LogisticCompany>
 */
class LogisticCompanyFactory extends Factory
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
            'city' => $this->faker->city,
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->streetAddress,
            'email' => $this->faker->unique()->companyEmail,
        ];
    }
}
