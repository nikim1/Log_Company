<?php

namespace Tests\Unit;

use App\Models\LogisticCompany;
use App\Models\Office;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogisticCompanyTest extends TestCase
{
    use RefreshDatabase;

    protected $company;

    protected function setUp(): void
    {
        parent::setUp();

        $this->company = LogisticCompany::factory()->create();
    }

    public function test_company_can_be_created()
    {
        $this->assertDatabaseHas('logistic_companies', [
            'name' => $this->company->name,
        ]);
    }

    public function test_company_can_be_updated()
    {
        $this->company->update(['name' => 'New Name']);

        $this->assertDatabaseHas('logistic_companies', [
            'id' => $this->company->id,
            'name' => 'New Name',
        ]);
    }

    public function test_company_can_be_deleted()
    {
        $this->company->delete();
        $this->assertSoftDeleted('logistic_companies', [
            'id' => $this->company->id,
        ]);

        $this->company->restore();
        $this->assertNotSoftDeleted('logistic_companies', [
            'id' => $this->company->id,
        ]);
    }

    public function test_company_has_many_offices()
    {
        $office1 = Office::factory()->create(['company_id' => $this->company->id]);
        $office2 = Office::factory()->create(['company_id' => $this->company->id]);

        $this->assertEquals(2, $this->company->offices->count());
        $this->assertTrue($this->company->offices->contains($office1));
        $this->assertTrue($this->company->offices->contains($office2));

        $office1->delete();
        $this->company->refresh();
        $this->assertEquals(1, $this->company->offices->count());
        $this->assertFalse($this->company->offices->contains($office1));

        $office2->delete();
        $this->company->refresh();
        $this->assertEquals(0, $this->company->offices->count());
        $this->assertFalse($this->company->offices->contains($office2));
    }
}
