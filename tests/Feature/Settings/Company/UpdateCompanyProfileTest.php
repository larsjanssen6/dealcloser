<?php

namespace Tests\Feature\Settings\Company;

use App\Dealcloser\Core\User\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UpdateCompanyProfileTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_company_profile_page()
    {
        $permission = create(Permission::class, ['name' => 'edit-company-settings']);

        $role = create(Role::class, ['name' => 'super-admin']);
        $role->givePermissionTo($permission->name);

        $user = create(User::class)->assignRole($role->name);

        $this->actingAs($user)->get('/instellingen/bedrijf/profiel')
            ->assertSee('Update bedrijfsprofiel');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_company_profile_page()
    {
        create(Permission::class, ['name' => 'bewerk-bedrijf-instellingen']);

        $user = create(User::class);

        $this->actingAs($user)->get('/instellingen/bedrijf/profiel')
            ->assertRedirect('/')
            ->assertDontSee('Update bedrijfsprofiel');
    }

    /** @test */
    public function a_user_with_right_permission_can_update_company_profile()
    {
        $permission = create(Permission::class, ['name' => 'edit-company-settings']);

        $role = create(Role::class, ['name' => 'super-admin']);
        $role->givePermissionTo($permission->name);

        $user = create(User::class)->assignRole($role->name);

        $settings = [
            'name'          => 'Company',
            'email'         => 'info@company.com',
            'phone'         => '0623844932',
            'website'       => 'http://www.domain.com',
            'description'   => 'A short description',
        ];

        $this->actingAs($user)->patch('/instellingen/bedrijf/profiel', $settings)
            ->assertSessionHas('status', 'Bedrijfsprofiel geupdatet!');

        $this->assertDatabaseHas('settings', $settings);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_update_company_profile()
    {
        create(Permission::class, ['name' => 'edit-company-settings']);

        $user = create(User::class);

        $this->signIn($user);

        $settings = [
            'name'          => 'Company',
            'email'         => 'info@company.com',
            'phone'         => '0623844932',
            'website'       => 'http://www.domain.com',
            'description'   => 'A short description',
        ];

        $this->patch('/instellingen/bedrijf/profiel', $settings)
            ->assertSessionHas('status', 'Niet geautoriseerd!')
            ->assertRedirect('/');

        $this->assertDatabaseMissing('settings', $settings);
    }
}

