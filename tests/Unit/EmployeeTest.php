<?php

namespace Tests\Unit;

use App\Models\Employee;
use App\Models\Office;
use App\Models\Shipment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    protected $employee;

    protected function setUp(): void
    {
        parent::setUp();

        $this->employee = Employee::factory()->create();
    }

    public function test_employee_can_be_created()
    {
        $this->assertDatabaseHas('employees', [
            'user_id' => $this->employee->user_id,
        ]);
    }

    public function test_employee_can_be_updated()
    {
        $office = Office::factory()->create(['company_id' => $this->employee->company]);
        $this->employee->update(['office_id' => $office->id]);

        $this->assertDatabaseHas('employees', [
            'id' => $this->employee->id,
            'office_id' => $office->id,
        ]);
    }

    public function test_employee_can_be_deleted()
    {
        $this->employee->delete();
        $this->assertSoftDeleted('employees', [
            'id' => $this->employee->id,
        ]);

        $this->employee->restore();
        $this->assertNotSoftDeleted('employees', [
            'id' => $this->employee->id,
        ]);
    }

    public function test_employee_belongs_to_user()
    {
        $this->assertInstanceOf(\App\Models\User::class, $this->employee->user);
        $this->assertNotNull($this->employee->user);
    }

    public function test_employee_belongs_to_company()
    {
        $this->assertInstanceOf(\App\Models\LogisticCompany::class, $this->employee->company);
        $this->assertNotNull($this->employee->company);
    }

    public function test_employee_belongs_to_office()
    {
        $office = Office::factory()->create(['company_id' => $this->employee->company]);
        $this->employee->update(['office_id' => $office->id, 'position' => 'office']);

        $this->assertInstanceOf(\App\Models\Office::class, $this->employee->office);
        $this->assertNotNull($this->employee->office);
    }

    public function test_employee_has_many_shipments()
    {
        $shipment1 = Shipment::factory()->create(['registered_by' => $this->employee->id]);
        $shipment2 = Shipment::factory()->create(['registered_by' => $this->employee->id]);

        $this->assertEquals(2, $this->employee->shipments->count());
        $this->assertTrue($this->employee->shipments->contains($shipment1));
        $this->assertTrue($this->employee->shipments->contains($shipment2));

        $shipment1->delete();
        $this->employee->refresh();
        $this->assertEquals(1, $this->employee->shipments->count());
        $this->assertFalse($this->employee->shipments->contains($shipment1));

        $shipment2->delete();
        $this->employee->refresh();
        $this->assertEquals(0, $this->employee->shipments->count());
        $this->assertFalse($this->employee->shipments->contains($shipment2));
    }
}
