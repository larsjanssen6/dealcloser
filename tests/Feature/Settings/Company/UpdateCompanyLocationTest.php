<?php

namespace Tests\Feature\Settings\Company;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateCompanyLocationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_company_location_page()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-company-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $this->actingAs($this->user)->get('/instellingen/bedrijf/locatie')
            ->assertSee('Update bedrijfslocatie');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_company_location_page()
    {
        $this->actingAs($this->user)->get('/instellingen/bedrijf/locatie')
            ->assertRedirect('/')
            ->assertDontSee('Update bedrijfslocatie');
    }

    /** @test */
    public function a_user_with_right_permission_can_update_company_location()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-company-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $settings = [
            'address'   => 'Boschlaan 10',
            'zip'       => '5993HK',
            'city'      => 'Maasbree',
        ];

        $this->actingAs($this->user)->patch('/instellingen/bedrijf/locatie', $settings)
            ->assertSessionHas('status', 'Bedrijfslocatie geupdatet!');

        $this->assertDatabaseHas('settings', $settings);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_update_company_location()
    {
        $settings = [
            'address'   => 'Boschlaan 10',
            'zip'       => '5993HK',
            'city'      => 'Maasbree',
        ];

        $this->actingAs($this->user)->patch('/instellingen/bedrijf/locatie', $settings)
            ->assertSessionHas('status', 'Niet geautoriseerd!')
            ->assertRedirect('/');

        $this->assertDatabaseMissing('settings', $settings);
    }
}
