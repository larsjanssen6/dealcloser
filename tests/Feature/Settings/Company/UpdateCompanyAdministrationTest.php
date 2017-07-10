<?php

namespace Tests\Feature\Settings\Company;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateCompanyAdministrationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_company_administration_page()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-company-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $this->actingAs($this->user)->get('/instellingen/bedrijf/administratie')
            ->assertSee('Update bedrijfsadministratie');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_company_administration_page()
    {
        $this->actingAs($this->user)->get('/instellingen/bedrijf/administratie')
            ->assertRedirect('/')
            ->assertDontSee('Update bedrijfsadministratie');
    }

    /** @test */
    public function a_user_with_right_permission_can_update_company_administration()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-company-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $settings = [
            'kvk' => '8a9sdfasdf9jnkasa',
            'btw' => 'asdf0asf9uasodfas',
        ];

        $this->actingAs($this->user)->patch('/instellingen/bedrijf/administratie', $settings)
            ->assertSessionHas('status', 'Bedrijfsadministratie geupdatet!');

        $this->assertDatabaseHas('settings', $settings);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_update_company_administration()
    {
        $settings = [
            'kvk' => '8a9sdfasdf9jnkasa',
            'btw' => 'asdf0asf9uasodfas',
        ];

        $this->actingAs($this->user)->patch('/instellingen/bedrijf/administratie', $settings)
            ->assertSessionHas('status', 'Niet geautoriseerd!')
            ->assertRedirect('/');

        $this->assertDatabaseMissing('settings', $settings);
    }
}
