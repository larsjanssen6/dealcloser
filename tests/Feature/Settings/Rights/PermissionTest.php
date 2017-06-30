<?php

namespace Tests\Feature\Settings\Rights;

use App\Dealcloser\Core\User\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_with_right_permission_can_see_permission_page()
    {
        $permission = create(Permission::class, ['name' => 'edit-permission-settings']);

        $role = create(Role::class, ['name' => 'super-admin']);
        $role->givePermissionTo($permission->name);

        $user = create(User::class)->assignRole($role->name);

        $this->actingAs($user)->get('/instellingen/bedrijf/permissie')
            ->assertSee('Permissies');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_see_permission_page()
    {
        create(Permission::class, ['name' => 'edit-permission-settings']);

        $user = create(User::class);

        $this->actingAs($user)->get('/instellingen/bedrijf/permissie')
            ->assertRedirect('/')
            ->assertDontSee('Permissies');
    }

    /** @test */
    public function a_user_with_the_right_permission_can_assign_permission_to_role()
    {
        $permission = create(Permission::class, ['name' => 'edit-permission-settings']);
        $permissionToAssign = create(Permission::class, ['name' => 'bewerk-gebruik-instellingen']);

        $role = create(Role::class, ['name' => 'super-admin']);
        $role->givePermissionTo($permission->name);

        $user = create(User::class)->assignRole($role->name);

        $this->actingAs($user)->get(sprintf("/instellingen/bedrijf/permissie/update?role=%s&permission=%s", $role->id, $permissionToAssign->name))
            ->assertSessionHas('status', 'Permissie toegevoegd');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_assign_permission_to_role()
    {
        create(Permission::class, ['name' => 'edit-permission-settings']);
        $permissionToAssign = create(Permission::class, ['name' => 'bewerk-gebruik-instellingen']);

        $role = create(Role::class, ['name' => 'super-admin']);

        $user = create(User::class);

        $this->actingAs($user)->get(sprintf("/instellingen/bedrijf/permissie/update?role=%s&permission=%s", $role->id, $permissionToAssign->name))
            ->assertSessionHas('status', 'Niet geautoriseerd!');
    }

    /** @test */
    public function a_user_with_the_right_permission_can_revoke_permission_from_a_role()
    {
        $permission = create(Permission::class, ['name' => 'edit-permission-settings']);
        $permissionToRevoke = create(Permission::class, ['name' => 'bewerk-gebruik-instellingen']);

        $role = create(Role::class, ['name' => 'super-admin']);
        $role->givePermissionTo($permission->name);
        $role->givePermissionTo($permissionToRevoke->name);

        $user = create(User::class)->assignRole($role->name);

        $this->actingAs($user)->get(sprintf("/instellingen/bedrijf/permissie/update?role=%s&permission=%s", $role->id, $permissionToRevoke->name))
            ->assertSessionHas('status', 'Permissie ingetrokken');
    }

    /** @test */
    public function a_user_with_not_the_right_permission_can_not_revoke_permission_to_role()
    {
        create(Permission::class, ['name' => 'edit-permission-settings']);
        $permissionToRevoke = create(Permission::class, ['name' => 'bewerk-gebruik-instellingen']);

        $role = create(Role::class, ['name' => 'super-admin']);
        $role->givePermissionTo($permissionToRevoke->name);

        $user = create(User::class);

        $this->actingAs($user)->get(sprintf("/instellingen/bedrijf/permissie/update?role=%s&permission=%s", $role->id, $permissionToRevoke->name))
            ->assertSessionHas('status', 'Niet geautoriseerd!');
    }
}

