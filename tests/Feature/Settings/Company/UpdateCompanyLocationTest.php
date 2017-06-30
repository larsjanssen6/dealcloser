<?php

namespace Tests\Feature\Settings\Company;

use App\Dealcloser\Core\User\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UpdateCompanyLocationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_company_location_page()
    {
        $permission = create(Permission::class, ['name' => 'edit-company-settings']);

        $role = create(Role::class, ['name' => 'super-admin']);
        $role->givePermissionTo($permission->name);

        $user = create(User::class)->assignRole($role->name);

        $this->actingAs($user)->get('/instellingen/bedrijf/locatie')
            ->assertSee('Update bedrijfslocatie');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_company_location_page()
    {
        create(Permission::class, ['name' => 'edit-company-settings']);

        $user = create(User::class);

        $this->actingAs($user)->get('/instellingen/bedrijf/locatie')
            ->assertRedirect('/')
            ->assertDontSee('Update bedrijfslocatie');
    }

    /** @test */
    public function a_user_with_right_permission_can_update_company_location()
    {
        $permission = create(Permission::class, ['name' => 'edit-company-settings']);

        $role = create(Role::class, ['name' => 'super-admin']);
        $role->givePermissionTo($permission->name);

        $user = create(User::class)->assignRole($role->name);

        $this->signIn($user);

        $settings = [
            'address'   => 'Boschlaan 10',
            'zip'       => '5993HK',
            'city'      => 'Maasbree',
        ];

        $this->patch('/instellingen/bedrijf/locatie', $settings)
            ->assertSessionHas('status', 'Bedrijfslocatie geupdatet!');

        $this->assertDatabaseHas('settings', $settings);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_update_company_location()
    {
        create(Permission::class, ['name' => 'edit-company-settings']);

        $user = create(User::class);

        $this->signIn($user);

        $settings = [
            'address'   => 'Boschlaan 10',
            'zip'       => '5993HK',
            'city'      => 'Maasbree',
        ];

        $this->patch('/instellingen/bedrijf/locatie', $settings)
            ->assertSessionHas('status', 'Niet geautoriseerd!')
            ->assertRedirect('/');

        $this->assertDatabaseMissing('settings', $settings);
    }
}

