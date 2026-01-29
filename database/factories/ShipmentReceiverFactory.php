<?php

namespace Database\Factories;

use App\Models\ClientAddress;
use App\Models\Employee;
use App\Models\Office;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShipmentReceiver>
 */
class ShipmentReceiverFactory extends Factory
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
            'delivery_type' => $type,
            'office_id' => $type == 'office' ? Office::factory() : null,
            'address_id' => $type == 'address' ? ClientAddress::factory() : null,
            'courier_id' => Employee::factory()->create(['position' => 'courier'])->id,
        ];
    }
}
