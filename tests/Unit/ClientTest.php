<?php

namespace Tests\Unit;

use App\Models\Client;
use App\Models\ClientAddress;
use App\Models\Shipment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    protected $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = Client::factory()->create();
    }

    public function test_client_can_be_created()
    {
        $this->assertDatabaseHas('clients', [
            'phone' => $this->client->phone,
        ]);
    }

    public function test_client_can_be_updated()
    {
        $this->client->update(['phone' => '0888593456']);

        $this->assertDatabaseHas('clients', [
            'id' => $this->client->id,
            'phone' => '0888593456',
        ]);
    }

    public function test_client_can_be_deleted()
    {
        $this->client->delete();
        $this->assertSoftDeleted('clients', [
            'id' => $this->client->id,
        ]);

        $this->client->restore();
        $this->assertNotSoftDeleted('clients', [
            'id' => $this->client->id,
        ]);
    }

    public function test_client_belongs_to_user()
    {
        $this->assertInstanceOf(\App\Models\User::class, $this->client->user);
        $this->assertNotNull($this->client->user);
    }

    public function test_client_belongs_to_company()
    {
        $this->assertInstanceOf(\App\Models\LogisticCompany::class, $this->client->company);
        $this->assertNotNull($this->client->company);
    }

    public function test_client_has_many_address()
    {
        $address1 = ClientAddress::factory()->create(['client_id' => $this->client->id]);
        $address2 = ClientAddress::factory()->create(['client_id' => $this->client->id]);

        $this->assertEquals(2, $this->client->addresses->count());
        $this->assertTrue($this->client->addresses->contains($address1));
        $this->assertTrue($this->client->addresses->contains($address2));

        $address1->delete();
        $this->client->refresh();
        $this->assertEquals(1, $this->client->addresses->count());
        $this->assertFalse($this->client->addresses->contains($address1));

        $address2->delete();
        $this->client->refresh();
        $this->assertEquals(0, $this->client->addresses->count());
        $this->assertFalse($this->client->addresses->contains($address2));
    }

    public function test_client_has_many_sent_shipments()
    {
        $shipment1 = Shipment::factory()->create(['sender_id' => $this->client->id]);
        $shipment2 = Shipment::factory()->create(['sender_id' => $this->client->id]);

        $this->assertEquals(2, $this->client->sentShipments->count());
        $this->assertTrue($this->client->sentShipments->contains($shipment1));
        $this->assertTrue($this->client->sentShipments->contains($shipment2));

        $shipment1->delete();
        $this->client->refresh();
        $this->assertEquals(1, $this->client->sentShipments->count());
        $this->assertFalse($this->client->sentShipments->contains($shipment1));

        $shipment2->delete();
        $this->client->refresh();
        $this->assertEquals(0, $this->client->sentShipments->count());
        $this->assertFalse($this->client->sentShipments->contains($shipment2));
    }

    public function test_client_has_many_received_shipments()
    {
        $shipment1 = Shipment::factory()->create(['receiver_id' => $this->client->id]);
        $shipment2 = Shipment::factory()->create(['receiver_id' => $this->client->id]);

        $this->assertEquals(2, $this->client->receivedShipments->count());
        $this->assertTrue($this->client->receivedShipments->contains($shipment1));
        $this->assertTrue($this->client->receivedShipments->contains($shipment2));

        $shipment1->delete();
        $this->client->refresh();
        $this->assertEquals(1, $this->client->receivedShipments->count());
        $this->assertFalse($this->client->receivedShipments->contains($shipment1));

        $shipment2->delete();
        $this->client->refresh();
        $this->assertEquals(0, $this->client->receivedShipments->count());
        $this->assertFalse($this->client->receivedShipments->contains($shipment2));
    }
}
