<?php

namespace Tests\Unit;

use App\Models\ClientAddress;
use App\Models\Office;
use App\Models\Shipment;
use App\Models\ShipmentReceiver;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShipmentReceiverTest extends TestCase
{
    use RefreshDatabase;

    protected $receiveShipment;

    protected function setUp(): void
    {
        parent::setUp();

        $this->receiveShipment = ShipmentReceiver::factory()->create();
    }

    public function test_receive_shipment_can_be_created()
    {
        $this->assertDatabaseHas('shipment_receivers', [
            'address_id' => $this->receiveShipment->address_id,
        ]);
    }

    public function test_receive_shipment_can_be_updated()
    {
        $shipment = Shipment::factory()->create();
        $this->receiveShipment->update(['shipment_id' => $shipment->id]);

        $this->assertDatabaseHas('shipment_receivers', [
            'id' => $this->receiveShipment->id,
            'shipment_id' => $shipment->id,
        ]);
    }

    public function test_receive_shipment_can_be_deleted()
    {
        $this->receiveShipment->delete();
        $this->assertSoftDeleted('shipment_receivers', [
            'id' => $this->receiveShipment->id,
        ]);

        $this->receiveShipment->restore();
        $this->assertNotSoftDeleted('shipment_receivers', [
            'id' => $this->receiveShipment->id,
        ]);
    }

    public function test_receive_shipment_belongs_to_shipment()
    {
        $this->assertInstanceOf(\App\Models\Shipment::class, $this->receiveShipment->shipment);
        $this->assertNotNull($this->receiveShipment->shipment);
    }

    public function test_receive_shipment_belongs_to_office()
    {
        $office = Office::factory()->create();
        $this->receiveShipment->update(['office_id' => $office->id]);

        $this->assertInstanceOf(\App\Models\Office::class, $this->receiveShipment->office);
        $this->assertNotNull($this->receiveShipment->office);
    }

    public function test_receive_shipment_belongs_to_address()
    {
        $address = ClientAddress::factory()->create();
        $this->receiveShipment->update(['address_id' => $address->id]);

        $this->assertInstanceOf(\App\Models\ClientAddress::class, $this->receiveShipment->address);
        $this->assertNotNull($this->receiveShipment->address);
    }

    public function test_receive_shipment_belongs_to_courier()
    {
        $this->assertInstanceOf(\App\Models\Employee::class, $this->receiveShipment->courier);
        $this->assertNotNull($this->receiveShipment->courier);
    }
}
