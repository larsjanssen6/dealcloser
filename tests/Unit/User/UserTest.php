<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use App\Dealcloser\Core\User\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = create(User::class, ['name' => 'Jan', 'preposition' => 'van', 'last_name' => 'Janssen']);
    }

    /** @test */
    public function it_can_receive_his_full_name_with_preposition()
    {
        $this->assertEquals($this->user->fullName, 'Jan van Janssen');
    }

    /** @test */
    public function it_can_receive_his_full_name_without_preposition()
    {
        $user = create(User::class, ['name' => 'Jan', 'preposition' => null, 'last_name' => 'Janssen']);
        $this->assertEquals($user->fullName, 'Jan Janssen');
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
