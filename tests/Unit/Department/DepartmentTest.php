<?php

namespace Tests\Unit\Department;

use Tests\TestCase;
use App\Dealcloser\Core\Department\Department;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DepartmentTest extends TestCase
{
    use DatabaseMigrations;

    protected $department;

    public function setUp()
    {
        parent::setUp();

        $this->department = create(Department::class);
    }

    /** @test */
    public function it_has_users()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->department->users
        );
    }
}
