<?php

namespace Database\Factories;

use App\Models\LogisticCompany;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state(function () {
                return [
                    'role_id' => Role::where('name', 'client')->first()->id,
                ];
            }),
            'company_id' => LogisticCompany::factory(),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
