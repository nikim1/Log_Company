<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipment>
 */
class ShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['pending', 'at_office', 'delivered', 'in_transit']);
        return [
            'sender_id' => Client::factory(),
            'receiver_id' => Client::factory(),
            'weight' => $this->faker->randomFloat(2, 1, 20),
            'price' => $this->faker->randomFloat(2, 10, 200),
            'status' => $status,
            'delivered_at' => $status == 'in_transit' ? now() : null,
            'registered_by' => Employee::factory(),
        ];
    }
}
