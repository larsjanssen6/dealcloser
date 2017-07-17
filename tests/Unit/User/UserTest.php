<?php

namespace Tests\Unit\User;

use App\Dealcloser\Core\User\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = create(User::class, ['name' => 'Lars', 'last_name' => 'Janssen']);
    }

    /** @test */
    public function it_can_receive_his_full_name()
    {
        $this->assertEquals($this->user->fullName, 'Lars Janssen');
    }

    /** @test */
    public function it_can_be_inactive()
    {
        $this->assertFalse($this->user->isActive());
    }

    /** @test */
    public function it_can_be_active()
    {
        $this->user->active = 1;
        $this->assertTrue($this->user->isActive());
    }

    /** @test */
    public function it_has_a_department()
    {
        $this->assertInstanceOf('App\Dealcloser\Core\Department\Department', $this->user->department);
    }
}
