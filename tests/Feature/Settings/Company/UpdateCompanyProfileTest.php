<?php

namespace Tests\Feature\Settings\Company;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateCompanyProfileTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_company_profile_page()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-company-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $this->actingAs($this->user)->get('/instellingen/bedrijf/profiel')
            ->assertSee('Update bedrijfsprofiel');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_company_profile_page()
    {
        $this->actingAs($this->user)->get('/instellingen/bedrijf/profiel')
            ->assertRedirect('/')
            ->assertDontSee('Update bedrijfsprofiel');
    }

    /** @test */
    public function a_user_with_right_permission_can_update_company_profile()
    {
        $this->superAdminRole->givePermissionTo($this->permissions['edit-company-settings']);
        $this->user->assignRole($this->superAdminRole->name);

        $settings = [
            'name'          => 'Company',
            'email'         => 'info@company.com',
            'phone'         => '623844932',
            'website'       => 'http://www.domain.com',
            'description'   => 'A short description',
        ];

        $this->actingAs($this->user)->patch('/instellingen/bedrijf/profiel', $settings)
            ->assertSessionHas('status', 'Bedrijfsprofiel geupdatet!');

        $this->assertDatabaseHas('settings', $settings);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_update_company_profile()
    {
        $settings = [
            'name'          => 'Company',
            'email'         => 'info@company.com',
            'phone'         => '0623844932',
            'website'       => 'http://www.domain.com',
            'description'   => 'A short description',
        ];

        $this->actingAs($this->user)->patch('/instellingen/bedrijf/profiel', $settings)
            ->assertSessionHas('status', 'Niet geautoriseerd!')
            ->assertRedirect('/');

        $this->assertDatabaseMissing('settings', $settings);
    }
}
