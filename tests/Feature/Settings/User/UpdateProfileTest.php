<?php

namespace Tests\Feature\Settings\Profile;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UpdateProfileTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_update_his_own_profile()
    {
        $user = [
            'name' => 'name',
            'last_name' => 'last_name',
            'email' => 'domain@corporation.com',
            'function' => 'function'
        ];

        $this->actingAs($this->user)->patch('/instellingen/profiel/', $user)
            ->assertSessionHas(['status' => 'Profiel geupdatet!']);

        $this->assertDatabaseHas('users', $user);
    }
}

