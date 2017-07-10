<?php

namespace Tests\Feature\Settings\Usage;

use App\Dealcloser\Core\Settings\Settings;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UpdateUsageTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_company_usage_page()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-usage-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $this->actingAs($this->user)->get('/instellingen/bedrijf/gebruik')
            ->assertSee('Update bedrijfsgebruik');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_company_usage_page()
    {
        $this->actingAs($this->user)->get('/instellingen/bedrijf/gebruik')
            ->assertRedirect('/')
            ->assertDontSee('Update bedrijfsgebruik');
    }

    /** @test */
    public function a_user_with_right_permission_can_update_company_usage()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-usage-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $settings = [
            'users'     => 12,
            'active'    => '2017-05-10 17:38:00',
            'license'   => '11324543132443',
        ];

        $this->actingAs($this->user)->patch('/instellingen/bedrijf/gebruik', $settings)
            ->assertSessionHas('status', 'Bedrijfsgebruik geupdatet!');

        $this->assertDatabaseHas('settings', $settings);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_update_company_usage()
    {
        $settings = [
            'users'     => 12,
            'active'    => '2017-05-10 17:38:00',
            'license'   => '11324543132443',
        ];

        $this->actingAs($this->user)->patch('/instellingen/bedrijf/gebruik', $settings)
            ->assertSessionHas('status', 'Niet geautoriseerd!')
            ->assertRedirect('/');

        $this->assertDatabaseMissing('settings', $settings);
    }

    /** @test */
    public function a_user_with_right_permission_can_sign_in_when_app_is_not_active()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['application-is-always-active']);
        $this->user->assignRole($this->superAdminRole->name);

        Settings::set(['active' => Carbon::now()->subDays(1)]);

        $this->post('/', [
            'email'     => $this->user->email,
            'password'  => 'secret',
        ])
            ->assertRedirect('/dashboard')
            ->assertSessionHas('status', sprintf('Welkom %s', $this->user->name));
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_sign_in_when_app_is_not_active()
    {
        Settings::set(['active' => Carbon::now()->subDays(1)]);

        $this->post('/', [
            'email'     => $this->user->email,
            'password'  => 'secret',
        ])
            ->assertRedirect('/')
            ->assertSessionHas('status', 'Applicatie is niet actief, contacteer de beheerder');
    }
}
