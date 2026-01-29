<?php

namespace Tests\Unit;

use App\Models\ClientAddress;
use App\Models\Office;
use App\Models\Shipment;
use App\Models\ShipmentSender;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShipmentSenderTest extends TestCase
{
    use RefreshDatabase;

    protected $sendShipment;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sendShipment = ShipmentSender::factory()->create();
    }

    public function test_send_shipment_can_be_created()
    {
        $this->assertDatabaseHas('shipment_senders', [
            'address_id' => $this->sendShipment->address_id,
        ]);
    }

    public function test_send_shipment_can_be_updated()
    {
        $shipment = Shipment::factory()->create();
        $this->sendShipment->update(['shipment_id' => $shipment->id]);

        $this->assertDatabaseHas('shipment_senders', [
            'id' => $this->sendShipment->id,
            'shipment_id' => $shipment->id,
        ]);
    }

    public function test_send_shipment_can_be_deleted()
    {
        $this->sendShipment->delete();
        $this->assertSoftDeleted('shipment_senders', [
            'id' => $this->sendShipment->id,
        ]);

        $this->sendShipment->restore();
        $this->assertNotSoftDeleted('shipment_senders', [
            'id' => $this->sendShipment->id,
        ]);
    }

    public function test_send_shipment_belongs_to_shipment()
    {
        $this->assertInstanceOf(\App\Models\Shipment::class, $this->sendShipment->shipment);
        $this->assertNotNull($this->sendShipment->shipment);
    }

    public function test_send_shipment_belongs_to_office()
    {
        $office = Office::factory()->create();
        $this->sendShipment->update(['office_id' => $office->id]);

        $this->assertInstanceOf(\App\Models\Office::class, $this->sendShipment->office);
        $this->assertNotNull($this->sendShipment->office);
    }

    public function test_send_shipment_belongs_to_address()
    {
        $address = ClientAddress::factory()->create();
        $this->sendShipment->update(['address_id' => $address->id]);

        $this->assertInstanceOf(\App\Models\ClientAddress::class, $this->sendShipment->address);
        $this->assertNotNull($this->sendShipment->address);
    }
}
