<?php

namespace Tests\Unit\Helpers;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AppIsActiveTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_is_active_no_date_is_stored()
    {
        $this->assertTrue(appIsActive(null, $this->user));
    }

    /** @test */
    public function it_is_active_date_is_in_the_future()
    {
        $this->assertTrue(appIsActive(Carbon::now()->addDay(), $this->user));
    }

    /** @test */
    public function it_is_active_user_has_correct_permission()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['application-is-always-active']);
        $this->user->assignRole($this->superAdminRole->name);

        $this->assertTrue(appIsActive(Carbon::now()->subDay(), $this->user));
    }

    /** @test */
    public function it_is_not_active_date_is_in_past()
    {
        $this->assertFalse(appIsActive(Carbon::now()->subDay(), $this->user));
    }
}
