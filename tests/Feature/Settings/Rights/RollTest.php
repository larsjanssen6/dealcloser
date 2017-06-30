<?php

namespace Tests\Feature\Settings\Rights;

use App\Dealcloser\Core\User\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RollTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_role_page()
    {
        $permission = create(Permission::class, ['name' => 'edit-role-settings']);

        $role = create(Role::class, ['name' => 'super-admin']);
        $role->givePermissionTo($permission->name);

        $user = create(User::class)->assignRole($role->name);

        $this->actingAs($user)->get('/instellingen/bedrijf/role')
            ->assertSee('Rollen');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_role_page()
    {
        create(Permission::class, ['name' => 'edit-role-settings']);

        $user = create(User::class);

        $this->actingAs($user)->get('/instellingen/bedrijf/role')
            ->assertRedirect('/')
            ->assertDontSee('Rollen');
    }

    /** @test */
    public function a_user_with_right_permission_can_create_a_role()
    {
        $permission = create(Permission::class, ['name' => 'edit-role-settings']);

        $role = create(Role::class, ['name' => 'super-admin']);
        $role->givePermissionTo($permission->name);

        $user = create(User::class)->assignRole($role->name);

        $role = [
            'name' => 'Account-manager'
        ];

        $this->actingAs($user)->post('/instellingen/bedrijf/role', $role)
            ->assertSessionHas('status', 'Role aangemaakt');

        $this->assertDatabaseHas('roles', $role);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_create_a_role()
    {
        create(Permission::class, ['name' => 'edit-role-settings']);

        $user = create(User::class);

        $role = [
            'name' => 'account-manager'
        ];

        $this->actingAs($user)->post('/instellingen/bedrijf/role', $role)
            ->assertSessionHas('status', 'Niet geautoriseerd!')
            ->assertRedirect('/');

        $this->assertDatabaseMissing('roles', $role);
    }

    /** @test */
    public function a_user_with_right_permission_can_update_a_role()
    {
        $permission = create(Permission::class, ['name' => 'edit-role-settings']);

        $role = create(Role::class, ['name' => 'super-admin']);
        $role->givePermissionTo($permission->name);

        $user = create(User::class)->assignRole($role->name);

        $toUpdate = [
            'name' => 'Admin'
        ];

        $this->actingAs($user)->patch('instellingen/bedrijf/role/' . $role->id, $toUpdate)
            ->assertJson(['status' => 'Rol geupdatet.']);

        $this->assertDatabaseHas('roles', $toUpdate);
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_update_a_role()
    {
        create(Permission::class, ['name' => 'edit-role-settings']);
        $role = create(Role::class, ['name' => 'super-admin']);

        $user = create(User::class);

        $toUpdate = [
            'name' => 'admin'
        ];

        $this->actingAs($user)->patchJson('instellingen/bedrijf/role/' . $role->id, $toUpdate)
            ->assertJson(['status' => 'Niet geautoriseerd!']);

        $this->assertDatabaseMissing('roles', ['name' => 'admin']);
    }

    /** @test */
    public function a_user_with_right_permission_can_destroy_a_role()
    {
        $permission = create(Permission::class, ['name' => 'edit-role-settings']);
        $toDelete = create(Role::class, ['name' => 'admin']);

        $role = create(Role::class, ['name' => 'super-admin']);
        $role->givePermissionTo($permission->name);

        $user = create(User::class)->assignRole('super-admin');

        $this->actingAs($user)->delete('instellingen/bedrijf/role/' . $toDelete->id)
            ->assertJson(['status' => 'Rol verwijderd.']);

        $this->assertDatabaseMissing('roles', $toDelete->toArray());
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_destroy_a_role()
    {
        create(Permission::class, ['name' => 'edit-role-settings']);
        $role = create(Role::class, ['name' => 'super-admin']);

        $user = create(User::class);

        $this->actingAs($user)->deleteJson('instellingen/bedrijf/role/' . $role->id)
            ->assertJson(['status' => 'Niet geautoriseerd!']);

        $this->assertDatabaseHas('roles', $role->toArray());
    }

    /** @test */
    public function a_user_can_not_destroy_his_own_role()
    {
        $permission = create(Permission::class, ['name' => 'edit-role-settings']);
        $role = create(Role::class, ['name' => 'super-admin']);

        $role->givePermissionTo($permission->name);
        $user = create(User::class)->assignRole($role->name);

        $this->actingAs($user)->deleteJson('instellingen/bedrijf/role/' . $role->id)
            ->assertJson(['status' => 'U kunt deze rol niet verwijder. Koppel uzelf eerst aan een andere rol.']);

        $this->assertDatabaseHas('roles', $role->toArray());
    }

    /** @test */
    public function a_role_that_already_exists_can_not_be_created()
    {
        $permission = create(Permission::class, ['name' => 'edit-role-settings']);
        $role = create(Role::class, ['name' => 'super-admin']);

        $role->givePermissionTo($permission->name);
        $user = create(User::class)->assignRole($role->name);

        $role = [
            'name' => 'super-admin'
        ];

        $this->actingAs($user)->post('instellingen/bedrijf/role', $role)
            ->assertSessionHasErrors('name');
    }
}

