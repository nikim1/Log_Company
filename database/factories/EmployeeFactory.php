<?php

namespace Database\Factories;

use App\Models\LogisticCompany;
use App\Models\Office;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $position = $this->faker->randomElement(['office', 'courier']);
        return [
            'user_id' => User::factory(),
            'company_id' => LogisticCompany::factory(),
            'office_id' => $position == 'courier' ? NULL : Office::factory(),
            'position' => $position,
        ];
    }
}
