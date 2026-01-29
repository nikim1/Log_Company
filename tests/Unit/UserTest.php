<?php

namespace Tests\Unit;

use App\Models\Client;
use App\Models\Employee;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_user_can_be_created()
    {
        $this->assertDatabaseHas('users', [
            'name' => $this->user->name,
        ]);
    }

    public function test_user_can_be_updated()
    {
        $this->user->update(['name' => 'New Name']);

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => 'New Name',
        ]);
    }

    public function test_user_can_be_deleted()
    {
        $this->user->delete();
        $this->assertSoftDeleted('users', [
            'id' => $this->user->id,
        ]);

        $this->user->restore();
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
        ]);
    }

    public function test_user_belongs_to_role()
    {
        $this->assertInstanceOf(\App\Models\Role::class, $this->user->role);
        $this->assertNotNull($this->user->role);
    }

    public function test_user_belongs_has_role()
    {
        $role = $this->user->role;
        $this->assertTrue($this->user->hasRole($role->name));
        $this->assertFalse($this->user->hasRole('false'));
    }

    public function test_user_has_one_employee()
    {
        $this->user->update(['role_id' => 3]); // role_id 3 is office
        $employee = Employee::factory()->create(['user_id' => $this->user->id]);

        $this->assertInstanceOf(Employee::class, $this->user->employee);
        $this->assertEquals($employee->id, $this->user->employee->id);
    }

    public function test_user_has_one_client()
    {
        $this->user->update(['role_id' => 4]); // role_id 4 is client
        $client = Client::factory()->create(['user_id' => $this->user->id]);

        $this->assertInstanceOf(Client::class, $this->user->client);
        $this->assertEquals($client->id, $this->user->client->id);
    }
}
