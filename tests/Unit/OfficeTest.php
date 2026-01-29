<?php

namespace Tests\Unit;

use App\Models\Office;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OfficeTest extends TestCase
{
    use RefreshDatabase;

    protected $office;

    protected function setUp(): void
    {
        parent::setUp();

        $this->office = Office::factory()->create();
    }

    public function test_office_can_be_created()
    {
        $this->assertDatabaseHas('offices', [
            'name' => $this->office->name,
        ]);
    }

    public function test_office_can_be_updated()
    {
        $this->office->update(['name' => 'New Name']);

        $this->assertDatabaseHas('offices', [
            'id' => $this->office->id,
            'name' => 'New Name',
        ]);
    }

    public function test_office_can_be_deleted()
    {
        $this->office->delete();
        $this->assertSoftDeleted('offices', [
            'id' => $this->office->id,
        ]);

        $this->office->restore();
        $this->assertNotSoftDeleted('offices', [
            'id' => $this->office->id,
        ]);
    }

    public function test_office_belongs_to_company()
    {
        $this->assertInstanceOf(\App\Models\LogisticCompany::class, $this->office->company);
        $this->assertNotNull($this->office->company);
    }
}
