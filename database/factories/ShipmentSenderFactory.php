<?php

namespace Database\Factories;

use App\Models\ClientAddress;
use App\Models\Employee;
use App\Models\Office;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShipmentSender>
 */
class ShipmentSenderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['office', 'address']);
        return [
            'shipment_id' => Shipment::factory(),
            'sender_type' => $type,
            'office_id' => $type == 'office' ? Office::factory() : null,
            'address_id' => $type == 'address' ? ClientAddress::factory() : null,
        ];
    }
}
