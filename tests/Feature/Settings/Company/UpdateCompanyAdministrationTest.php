<?php

namespace Tests\Feature\Settings\Company;

use App\Dealcloser\Core\User\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UpdateCompanyAdministrationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_company_administration_page()
    {
        $permission = create(Permission::class, ['name' => 'edit-company-settings']);

        $role = create(Role::class, ['name' => 'super-admin']);
        $role->givePermissionTo($permission->name);

        $user = create(User::class)->assignRole($role->name);

        $this->actingAs($user)->get('/instellingen/bedrijf/administratie')
            ->assertSee('Update bedrijfsadministratie');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_company_administration_page()
    {
        create(Permission::class, ['name' => 'edit-company-settings']);

        $user = create(User::class);

        $this->actingAs($user)->get('/instellingen/bedrijf/administratie')
            ->assertRedirect('/')
            ->assertDontSee('Update bedrijfsadministratie');
    }

    /** @test */
    public function a_user_with_right_permission_can_update_company_administration()
    {
        $permission = create(Permission::class, ['name' => 'edit-company-settings']);

        $role = create(Role::class, ['name' => 'super-admin']);
        $role->givePermissionTo($permission->name);

        $user = create(User::class)->assignRole($role->name);

        $this->signIn($user);

        $settings = [
            'kvk'           => '8a9sdfasdf9jnkasa',
            'btw'           => 'asdf0asf9uasodfas',
        ];

        $this->patch('/instellingen/bedrijf/administratie', $settings)
            ->assertSessionHas('status', 'Bedrijfsadministratie geupdatet!');

        $this->assertDatabaseHas('settings', $settings);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_update_company_administration()
    {
        create(Permission::class, ['name' => 'edit-company-settings']);

        $user = create(User::class);

        $this->signIn($user);

        $settings = [
            'kvk'           => '8a9sdfasdf9jnkasa',
            'btw'           => 'asdf0asf9uasodfas',
        ];

        $this->patch('/instellingen/bedrijf/administratie', $settings)
            ->assertSessionHas('status', 'Niet geautoriseerd!')
            ->assertRedirect('/');

        $this->assertDatabaseMissing('settings', $settings);
    }
}

