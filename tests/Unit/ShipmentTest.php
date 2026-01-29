<?php

namespace Tests\Unit;

use App\Models\Employee;
use App\Models\Office;
use App\Models\Shipment;
use App\Models\ShipmentReceiver;
use App\Models\ShipmentSender;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShipmentTest extends TestCase
{
    use RefreshDatabase;

    protected $shipment;

    protected function setUp(): void
    {
        parent::setUp();

        $this->shipment = Shipment::factory()->create();
    }

    public function test_shipment_can_be_created()
    {
        $this->assertDatabaseHas('shipments', [
            'price' => $this->shipment->price,
        ]);
    }

    public function test_shipment_can_be_updated()
    {
        $this->shipment->update(['price' => '25.00']);

        $this->assertDatabaseHas('shipments', [
            'id' => $this->shipment->id,
            'price' => '25.00',
        ]);
    }

    public function test_shipment_can_be_deleted()
    {
        $this->shipment->delete();
        $this->assertSoftDeleted('shipments', [
            'id' => $this->shipment->id,
        ]);

        $this->shipment->restore();
        $this->assertNotSoftDeleted('shipments', [
            'id' => $this->shipment->id,
        ]);
    }

    public function test_shipment_belongs_to_sender()
    {
        $this->assertInstanceOf(\App\Models\Client::class, $this->shipment->sender);
        $this->assertNotNull($this->shipment->sender);
    }

    public function test_shipment_belongs_to_receiver()
    {
        $this->assertInstanceOf(\App\Models\Client::class, $this->shipment->receiver);
        $this->assertNotNull($this->shipment->receiver);
    }

    public function test_shipment_belongs_to_registeredBy()
    {
        $office = Office::factory()->create(['company_id' => $this->shipment->sender->company_id]);
        $officeEmployee = Employee::factory()->create([
            'company_id' => $this->shipment->sender->company_id,
            'office_id' => $office->id,
            'position' => 'office',
        ]);
        $this->shipment->update(['registered_by' => $officeEmployee->id]);

        $this->assertInstanceOf(\App\Models\Employee::class, $this->shipment->registeredBy);
        $this->assertNotNull($this->shipment->registeredBy);
    }

    public function test_shipment_belongs_has_one_send_shipment()
    {
        $sendShipment = ShipmentSender::factory()->create(['shipment_id' => $this->shipment->id]);

        $this->assertInstanceOf(\App\Models\ShipmentSender::class, $this->shipment->sendShipment);
        $this->assertNotNull($this->shipment->sendShipment);
    }

    public function test_shipment_belongs_has_one_receive_shipment()
    {
        $sendShipment = ShipmentReceiver::factory()->create(['shipment_id' => $this->shipment->id]);

        $this->assertInstanceOf(\App\Models\ShipmentReceiver::class, $this->shipment->receiveShipment);
        $this->assertNotNull($this->shipment->receiveShipment);
    }
}
